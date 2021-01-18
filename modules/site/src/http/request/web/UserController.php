<?php namespace Site\Http\Request\Web;

use Auth;
use Carbon\Carbon;
use Event;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Arr;
use Log;
use Mail;
use Poppy\Framework\Classes\Resp;
use Poppy\System\Action\Pam;
use Poppy\System\Http\Request\Web\WebController;
use Poppy\System\Models\PamAccount;
use Session;
use Throwable;
use Validator;
use View;

class UserController extends WebController
{


	public function profile()
	{
		return view('slt::user.profile');
	}

	public function login(Request $request, $type = 'normal')
	{
		$guard = Auth::guard(PamAccount::GUARD_WEB);
		if (is_post()) {
			$passport = $request->input('passport');
			$password = $request->input('password');
			$remember = $request->input('remember_me');

			$Pam = new Pam();
			if ($Pam->loginCheck($passport, $password, PamAccount::GUARD_WEB, $remember)) {
				if (!empty($type) && $type == 'mini') {
					$forward = 'top_reload|1';
				}
				else {
					$go        = input('_go');
					$private   = false;
					$not_jumps = [
						'home/head',
					];
					foreach ($not_jumps as $url) {
						if (strpos($go, $url) !== false) {
							$private = true;
						}
					}
					$url     = $private ? route('slt:user.profile') : $go;
					$forward = 'location|' . $url;
				}

				return Resp::web(Resp::SUCCESS, '登录成功', $forward);
			}

			return Resp::web(Resp::ERROR, $Pam->getError());
		}

		if ($guard->user()) {
			return Resp::web(Resp::SUCCESS, '您已登录', [
				'location' => route('slt:user.profile'),
			]);
		}
		if ($type == 'mini') {
			return view('web.user.mini_login');
		}

		return view('site::user.login');
	}

	/**
	 * 操作注册
	 * @param Request $request
	 * @param string  $type
	 * @return RedirectResponse
	 * @throws Throwable
	 */
	public function register(Request $request, $type = 'username')
	{
		$guard = Auth::guard(PamAccount::GUARD_WEB);
		if (!PamAccount::kvRegType($type, true)) {
			return Resp::web(Resp::ERROR, '注册类型不正确');
		}
		if (is_post()) {
			$validator = Validator::make(input(), [
				$type      => 'required',
				'password' => 'required',
				'agree'    => 'accepted',
				'captcha'  => 'required|captcha',
			], [], [
				$type     => PamAccount::kvRegType($type),
				'captcha' => '验证码',
			]);
			if ($validator->fails()) {
				return Resp::web(Resp::PARAM_ERROR, $validator->errors());
			}
			$account  = input($type);
			$password = input('password');

			$Pam = new Pam();
			if (!$Pam->register($account, $password)) {
				return Resp::web(Resp::ERROR, $Pam->getError(), '', $request->only([$type]));
			}
			$pam = $Pam->getPam();

			if ($guard->loginUsingId($pam->id)) {
				return Resp::web(Resp::SUCCESS, '注册成功, 登录用户系统', 'reload|1');
			}

			return Resp::web(Resp::ERROR, '系统异常');
		}

		return view('site::user.register', [
			'type' => $type,
		]);
	}

	/**
	 * 默认头像
	 * @param Request $request
	 * @return JsonResponse|RedirectResponse|Response|Redirector|\Illuminate\View\View
	 */
	public function avatar(Request $request)
	{
		if (is_post()) {
			$avatar = $request->input('avatar');
			FeUser::instance()->getProfile()->update([
				'avatar' => $avatar,
			]);

			return Resp::web('OK~头像保存成功', 'top_reload|1');
		}

		return view('web.user.avatar');
	}

	/**
	 * 登出
	 * @return JsonResponse|RedirectResponse|Response|Redirector
	 */
	public function logout()
	{
		Auth::guard(PamAccount::GUARD_WEB)->logout();

		return Resp::web(Resp::SUCCESS, '退出登录', 'location|' . route('site:user.login'));
	}

	public function getAuthLogout()
	{
		// 删除在线
		Session::remove('desktop_auth');
		Auth::logout();

		return Resp::web('退出授权登录成功', 'location|' . route('front_user.login'));
	}

	// 修改密码
	public function getPassword()
	{
		return view('front.user.password');
	}

	public function postPassword(UserPasswordRequest $request)
	{
		$old_password = $request->input('old_password');
		$new_password = $request->input('password');
		if (!PamAccount::checkPassword(Auth::user(), $old_password)) {
			return Resp::web('原密码错误');
		}
		PamAccount::changePassword(Auth::id(), $new_password);
		Auth::logout();
		Session::remove('front_validated');

		return Resp::web('OK~密码修改成功, 请重新登陆', 'reload_opener|1;time|1000');
	}

	public function getChangeEmail(Request $request)
	{
		// 修改email
		$code = $request->input('code');

		try {
			$de = SysCrypt::decode($code);
		} catch (Exception $e) {
			Log::error($e->getMessage());

			return Resp::web('非法访问, 请不要尝试解码!');
		}

		if (preg_match("/.*?#(\d+)#(.*?)#(\d+)/", $de, $match)) {
			$accountId = $match[1];
			$email     = $match[2];
			$unix      = $match[3];
			// 检测是否已经认证过
			$hour = Carbon::now()->diffInHours(Carbon::createFromTimestamp($unix), false);
			if ($hour <= -24) {
				return Resp::web('修改 Email 链接已经过期!');
			}
			$user = AccountFront::where('account_id', $accountId)->first();
			/** @var PamAccount $pam */
			$pam = PamAccount::find($accountId);
			if ($pam) {
				if ($pam->account_name == $email) {
					return Resp::web('email 已经修改过, 不得重复操作!');
				}

				// change account
				$pam->account_name = $email;
				$pam->save();

				// front verify
				$user->v_email = 'Y';
				$user->email   = $email;
				$user->save();

				return Resp::web('OK~邮箱已经修改为' . LmStr::hideEmail($email) . ', 请使用新邮箱登陆!');
			}

			return Resp::web('此链接已失效!');
		}

		return Resp::web('非法访问, 请不要尝试解码!');
	}

	/**
	 * 获取登陆日志
	 * @return \Illuminate\View\View
	 */
	public function getLoginLog()
	{
		$Log = PamLog::orderBy('created_at', 'desc');
		$Log->where('account_id', Auth::id());
		$items = $Log->paginate($this->pagesize);

		return view('front.user.login_log', [
			'items' => $items,
		]);
	}

	public function getCaptcha()
	{
		$builder = new CaptchaBuilder();
		$builder->build(150, 32);
		Session::set('captcha', $builder->getPhrase()); //存储验证码

		return response($builder->output())->header('Content-type', 'image/jpeg');
	}

	public function forgotPassword(Request $request)
	{
		if (is_post()) {
			$validator = Validator::make($request->all(), [
				'email'   => 'required|email',
				'captcha' => 'required',
			], [
				'email.required'   => '邮箱不能为空',
				'captcha.required' => '验证码不能为空',
			]);
			if ($validator->fails()) {
				return Resp::web($validator->errors());
			}
			$email   = $request->input('email');
			$captcha = $request->input('captcha');
			if ($captcha != Session::get('captcha')) {
				return Resp::web('验证码不正确');
			}
			/** @var PamAccount $account */
			$account = PamAccount::where('account_name', $email)->first();
			if (empty($account)) {
				return Resp::web('邮箱不存在');
			}
			$code = urlencode(SysCrypt::encode($account->id . '#' . StrHelper::random(10) . '#' . EnvHelper::time()));
			$link = route('web:user.reset_password', [$code]);

			Mail::send('daniu.email.find_pwd', [
				'email' => $account->account_name,
				'link'  => $link,
				'date'  => TimeHelper::datetime(),
			], function ($message) use ($account) {
				$message->from(env('MAIL_USERNAME'), site('site_name'));
				$message->to($account->account_name)->subject(site('site_name') . '密码重置');
			});

			return Resp::web('OK~密码重置邮件发送成功，请注意查收邮箱');
		}

		return view('front.user.forgot_password');
	}

	/** 重置密码
	 * @param $code
	 * @return Factory|RedirectResponse|Redirector|\Illuminate\View\View
	 */
	public function getResetPassword($code)
	{
		if (empty($code)) return Resp::web('验证码code不能为空');
		$decrypt     = SysCrypt::decode($code);
		$account_arr = explode('#', $decrypt);
		if (empty($account_arr['0'])) {
			return Resp::web('无效的邮箱认证码');
		}

		$unix = $account_arr['2'];
		// 检测是否已经认证过
		$hour = Carbon::now()->diffInHours(Carbon::createFromTimestamp($unix), false);
		if ($hour <= -24) {
			return Resp::web('邮箱验证链接已经过期!');
		}

		/** @var PamAccount $account */
		$account = PamAccount::find($account_arr['0']);
		if (empty($account)) {
			return Resp::web('无效的账号操作');
		}

		return view('front.user.reset_password', [
			'item' => $account,
		]);
	}

	/**
	 * 最终来修改密码
	 * @param Request $request
	 * @param         $id
	 * @return RedirectResponse|Redirector
	 */
	public function postResetPassword(Request $request, $id)
	{
		if (!$id) return Resp::web('id参数错误');
		$validator = Validator::make($request->all(), [
			'password'         => 'required',
			'confirm_password' => 'required',
		], [
			'password.required'         => '新密码不能为空',
			'confirm_password.required' => '确认密码不能为空',
		]);
		if ($validator->fails()) {
			return Resp::web($validator->errors());
		}
		$password         = $request->input('password');
		$confirm_password = $request->input('confirm_password');
		if ($password != $confirm_password) {
			return Resp::web('两次输入密码不一致');
		}

		PamAccount::changePassword($id, $password);
		Auth::logout();
		Session::remove('front_validated');

		return Resp::web('OK~密码重置成功, 请重新登陆', 'location|' . route('front_user.login'));
	}

	/**
	 * 验证邮箱真实性
	 * @param Request $request
	 * @return RedirectResponse|Redirector
	 */
	public function getVerifyEmail(Request $request)
	{
		$code = $request->input('code');

		try {
			$de = SysCrypt::decode($code);
		} catch (Exception $e) {
			Log::error($e->getMessage());

			return Resp::web('非法访问, 请不要尝试解码!');
		}

		if (preg_match("/.*?#(\d+)#.*?#(\d+)/", $de, $match)) {
			$accountId = $match[1];
			$unix      = $match[2];
			// 检测是否已经认证过
			$hour = Carbon::now()->diffInHours(Carbon::createFromTimestamp($unix), false);
			if ($hour <= -24) {
				return Resp::web('邮箱验证链接已经过期!');
			}
			$user = AccountFront::where('account_id', $accountId)->first();
			if ($user) {
				// 认证
				if ($user->v_email == 'Y') {
					return Resp::web('邮箱已经验证过!');
				}

				$accountName   = PamAccount::getAccountNameByAccountId($user->account_id);
				$user->v_email = 'Y';
				$user->email   = $accountName;
				$user->save();

				return Resp::web('OK~邮箱已经通过验证!');
			}

			return Resp::web('此验证码已经过期, 请不要重复验证!');
		}

		return Resp::web('非法访问, 请不要尝试解码!');
	}

	/**
	 * 发送验证邮件
	 * @return RedirectResponse|Redirector
	 */
	public function postVerifyEmail()
	{
		$link = route_url('front_user.verify_email', null, [
			'code' => SysCrypt::encode('verify_email#' . $this->accountId . '#' . str_random() . '#' . (LmEnv::time() - 6 * 3600)),
		]);
		try {
			$pam = $this->pam;
			Mail::send('daniu.email.verify_email', [
				'email' => $this->pam->account_name,
				'link'  => $link,
			], function ($message) use ($pam) {
				$message->from(env('MAIL_USERNAME'), site('site_name'));
				$message->to($pam->account_name)->subject(site('site_name') . '邮箱验证');
			});
			$hideMail = LmStr::hideEmail($pam->account_name);

			return Resp::web('OK~验证邮件已经发送至' . $hideMail . ', 请查收验证邮件!');
		} catch (Exception $e) {
			Log::error($e->getMessage());

			return Resp::web('邮件发送错误, 请联系管理员!');
		}
	}

	public function getModifyEmail()
	{
		return view('front.user.modify_email');
	}

	/**
	 * 发送修改的邮件
	 * @param Request $request
	 * @return RedirectResponse|Redirector
	 */
	public function postModifyEmail(Request $request)
	{
		$email     = $request->input('email');
		$validator = Validator::make([
			'email' => $email,
		], [
			'email' => 'required|email',
		]);
		if ($validator->fails()) {
			return Resp::web($validator->errors());
		}
		if ($this->pam->account_name == $email) {
			return Resp::web('您当前账户便是这个邮箱, 不必修改!');
		}
		// user use
		if (PamAccount::accountNameExists($email)) {
			return Resp::web('你填写的邮箱已经被占用!');
		}

		$link = route_url('front_user.change_email', null, [
			'code' => SysCrypt::encode('change_email#' . $this->accountId . '#' . $email . '#' . (LmEnv::time() - 6 * 3600)),
		]);
		try {
			Mail::send('daniu.email.change_email', [
				'email' => $email,
				'link'  => $link,
			], function ($message) use ($email) {
				$message->from(env('MAIL_USERNAME'), site('site_name'));
				$message->to($email)->subject(site('site_name') . '修改邮箱');
			});
			$hideMail = LmStr::hideEmail($email);

			return Resp::web('OK~验证邮件已经发送至' . $hideMail . ', 请查收验证邮件!');
		} catch (Exception $e) {
			Log::error($e->getMessage());

			return Resp::web('邮件发送错误, 请联系管理员!');
		}
	}

	public function getModifyPwd()
	{
		return view('front.user.modify_pwd');
	}

	public function postModifyPwd(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'password'         => 'required',
			'new_password'     => 'required',
			'confirm_password' => 'required',
		], [
			'password.required'         => '当前密码不能为空',
			'new_password.required'     => '新密码不能为空',
			'confirm_password.required' => '确认密码不能为空',
		]);
		if ($validator->fails()) {
			return Resp::web($validator->errors());
		}
		$old_password     = $request->input('password');
		$new_password     = $request->input('new_password');
		$confirm_password = $request->input('confirm_password');
		if ($new_password != $confirm_password) {
			return Resp::web('两次输入密码不一致');
		}

		if (!PamAccount::checkPassword($this->pam, $old_password)) {
			return Resp::web('原密码错误');
		}
		PamAccount::changePassword($this->pam->account_id, $new_password);
		Auth::logout();
		Session::remove('front_validated');

		return Resp::web('OK~密码修改成功, 请重新登陆', 'reload_opener|1;time|1000');
	}

	/** 用户基本资料 */
	public function getProfile()
	{
		return view('front.user.profile');
	}

	public function postProfile()
	{
		$input = Arr::except(input(), '_token');
		if ($this->front->url_address) {
			// custom url
			if (isset($input['url_address'])) {
				return Resp::web('个性自定义地址只能修改一次!');
			}
		}
		else {
			$url_address = '';
			if (isset($input['url_address'])) {
				$url_address = trim($input['url_address']);
			}
			if ($url_address) {
				if ($url_address && is_numeric($url_address)) {
					return Resp::web('不得输入纯数字个性地址');
				}
				// repeat 检测重复
				$short = trim($url_address);
				$num   = AccountFront::where('url_address', $short)->count();
				if ($num != 0) {
					return Resp::web('已经有人使用这个主页地址, 请更换后重新提交');
				}
			}
		}
		$validator = Validator::make($input, [
			'blog_url'    => 'url',
			'twitter_url' => 'url',
			'weibo_url'   => 'url',
			'zhihu_url'   => 'url',
			'url_address' => 'alpha_num',
		], [
			'blog_url.url'          => '请输入正确博客地址',
			'twitter_url.url'       => '请输入正确Twitter地址',
			'weibo_url.url'         => '请输入正确微博地址',
			'zhihu_url.url'         => '请输入正确知乎地址',
			'url_address.alpha_num' => '个性地址必须是字母/数字的组合',
		]);
		if ($validator->fails()) {
			return Resp::web($validator->errors());
		}

		$this->front->update($input);

		return Resp::web('OK~更新个人资料成功', 'reload|1');
	}

	public function nickname(Request $request)
	{
		if (is_post()) {
			$validator = Validator::make($request->all(), [
				'nickname' => 'required',
			], [
				'nickname.required' => '用户昵称不能为空',
			]);
			if ($validator->fails()) {
				return Resp::web($validator->errors());
			}
			$nickname = $request->input('nickname');
			//check 敏感词
			$sensitive = BadWords::where('badword', 'like', $nickname)->first();
			if ($sensitive) {
				return Resp::web('用户昵称中含有敏感词,不能使用');
			}

			$this->front->update(['nickname' => $nickname]);

			return Resp::web('OK~更改用户昵称成功', 'top_reload|1;');
		}

		return view('front.user.nickname');
	}

	/** 修改用户昵称
	 * @param Request $request
	 * @return RedirectResponse|Redirector
	 */
	public function postNickname(Request $request)
	{
	}

	public function getService()
	{
		return view('front.user.service', [
			'is_at_service' => AccountFront::isAtService($this->front),
		]);
	}

	public function getOrder()
	{
		$items = OrderService::where('account_id', $this->front->account_id)
			->where('status', OrderService::STATUS_FINISH)
			->get();

		return view('front.user.order', [
			'items' => $items,
		]);
	}

	public function getDonate()
	{
		return view('front.user.donate');
	}

	public function postDonate(Request $request)
	{
		$this->front->is_weixinpay     = $request->input('is_weixinpay');
		$this->front->is_alipay        = $request->input('is_alipay');
		$this->front->alipay_qrcode    = $request->input('alipay_qrcode');
		$this->front->weixinpay_qrcode = $request->input('weixinpay_qrcode');
		$this->front->save();

		return Resp::web('OK~已经将原型捐赠配置保存到服务器!');
	}

	public function postAttention($aim, $cancel = false)
	{
		if ($cancel) {
			FrontRelation::where('from_id', $this->front->account_id)
				->where('to_id', $aim)
				->forceDelete();
		}
		else {
			$aimUser = AccountFront::find($aim);
			Event::fire('daniu.attention', [$this->front, $aimUser]);

			FrontRelation::updateOrCreate([
				'from_id' => $this->front->account_id,
				'to_id'   => $aim,
			]);
		}

		AccountFront::calcAttentionAndFans($this->front->account_id, $aim);
		if ($cancel) {
			return Resp::web('OK~取消关注', 'reload|1');
		}

		return Resp::web('OK~已关注!', 'reload|1');
	}

	public function getP($string = null)
	{
		if (!$string) {
			if ($this->pam) {
				$string = $this->pam->account_id;
			}
			else {
				return Resp::web('页面入口错误!');
			}
		}
		if (is_numeric($string)) {
			$front = AccountFront::findOrFail($string);
		}
		else {
			$front = AccountFront::where('url_address', $string)->firstOrFail();
		}
		if (!$front) {
			return Resp::web('您输入的用户不存在');
		}

		$isPrivate = Prototype::where('userid', $front->account_id)->count();
		$isPrd     = PrdContent::where('account_id', $front->account_id)->where('parent_id', 0)->count();

		// rp
		$rp = PrototypeRp::where('account_id', $front->account_id)
			->where('status', PrototypeRp::STATUS_PASS)
			->where('ori_id', 0)
			->with('front')
			->get();

		// rplib
		$rplib = PrototypeRplib::where('account_id', $front->account_id)
			->where('status', PrototypeRplib::STATUS_PASS)
			->with('front')
			->get();

		$rpZanNum    = PrototypeRpStar::whereIn('rp_id', PrototypeRp::where('account_id', $front->account_id)->lists('id'))
			->where('type', PrototypeRpStar::TYPE_GOOD)->count();
		$rplibZanNum = PrototypeRplibStar::whereIn('rplib_id', PrototypeRp::where('account_id', $front->account_id)->lists('id'))
			->where('type', PrototypeRplibStar::TYPE_GOOD)->count();
		$zanNum      = $rpZanNum + $rplibZanNum;

		$rpDownloadNum    = PrototypeRp::where('account_id', $front->account_id)->where('ori_id', 0)->sum('download_num');
		$rpLibDownloadNum = PrototypeRplib::where('account_id', $front->account_id)->sum('download_num');
		$downloadNum      = $rpDownloadNum + $rpLibDownloadNum;

		return view('front.user.p', [
			'user'         => $front,
			'heat_map'     => FrontHot::heatMap($front->account_id),
			'is_prd'       => $isPrd,
			'is_private'   => $isPrivate,
			'rp_items'     => $rp,
			'rplib_items'  => $rplib,
			'zan_num'      => $zanNum,
			'download_num' => $downloadNum,
		]);
	}

	public function getCollection($type = 'fans', $account_id = null)
	{
		if (!$type) {
			$type = 'fans';
		}
		if (!$account_id) {
			$account_id = $this->front ? $this->front->account_id : 0;
		}
		if (!$account_id) {
			return Resp::web('用户账户错误');
		}
		$user = AccountFront::where('account_id', $account_id)->firstOrFail();
		switch ($type) {
			case 'attention':
				$attentions = FrontRelation::where('from_id', $user->account_id)
					->with(['to_pam', 'to_front'])
					->paginate()->appends(input());
				View::share('items', $attentions);
				break;
			case 'fans':
				$fans = FrontRelation::where('to_id', $user->account_id)
					->with(['from_pam', 'from_front'])
					->paginate()->appends(input());
				View::share('items', $fans);
				break;
		}

		return view('front.user.collection', [
			'user' => $user,
			'type' => $type,
		]);
	}
}
