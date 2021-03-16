<?php

namespace Rds\Models;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Poppy\System\Models\PamAccount;

/**
 * Sour\Sour\Models\UserProfile
 * @property int             $account_id           账户id
 * @property int             $invite_account_id    邀请人账号ID
 * @property string          $invite_code          邀请码
 * @property string          $qq                   qq 号码
 * @property string          $mobile               qq 号码
 * @property bool            $is_mobile_validate   手机认证状态
 * @property string          $email                email地址
 * @property bool            $is_email_validate    邮箱认证状态
 * @property string          $truename             联系人姓名
 * @property string          $chid                 身份证
 * @property string          $chid_pic_a           身份证扫描件A面
 * @property string          $chid_pic_b           身份证扫描件B面
 * @property string          $truename_failed_note 真实姓名验证原因
 * @property string          $truename_status      实名认证状态
 * @property bool            $is_truename_validate 实名认证状态
 * @property string          $nickname             昵称
 * @property string          $address              地址
 * @property string          $avatar               头像
 * @property float           $money                资金
 * @property int             $score                积分
 * @property float           $lock                 锁定资金
 * @property string          $area_name            所在地区
 * @property string          $question_title_1     密保问题
 * @property string          $question_title_2
 * @property string          $question_title_3
 * @property string          $question_answer_1    密保答案
 * @property string          $question_answer_2
 * @property string          $question_answer_3
 * @property bool            $is_question_validate 是否设置密保问题
 * @property string          $payword              支付密码
 * @property string          $payword_key          支付密码 key
 * @property string          $permission           用户权限控制
 * @property bool            $is_wx_pay            是否开启微信捐赠
 * @property string          $wx_pay_qrcode        微信支付二维码
 * @property bool            $is_alipay            支付宝支付
 * @property string          $alipay_qrcode        支付宝二维码
 * @property string          $description          个人介绍
 * @property string          $blog_url             blog 地址
 * @property string          $twitter_url          twitter 地址
 * @property string          $zhihu_url            知乎地址
 * @property string          $weibo_url            微博地址
 * @property string          $gender               性别 male:男, female: 女
 * @property int             $attention_num        我关注的数量
 * @property int             $fans_num             粉丝数量
 * @property-read PamAccount $pam
 * @mixin \Eloquent
 */
class UserProfile extends \Eloquent
{
	const V_TYPE_MOBILE   = 'mobile';
	const V_TYPE_TRUENAME = 'truename';
	const V_TYPE_EMAIL    = 'email';

	const TRUENAME_STATUS_NONE   = 'none';
	const TRUENAME_STATUS_WAIT   = 'wait';
	const TRUENAME_STATUS_PASSED = 'passed';
	const TRUENAME_STATUS_FAILED = 'failed';

	const GENDER_SECRET = 0;
	const GENDER_MALE   = 'male';
	const GENDER_FEMALE = 'female';

	protected $table = 'user_profile';

	protected $primaryKey = 'account_id';

	public $timestamps = false;

	protected $fillable = [
		'account_id',
		'invite_account_id',
		'invite_code',
		'qq',
		'mobile',
		'is_mobile_validate',
		'email',
		'is_email_validate',
		'truename',
		'chid',
		'chid_pic_a',
		'chid_pic_b',
		'truename_failed_note',
		'truename_status',
		'is_truename_validate',
		'nickname',
		'address',
		'avatar',
		'money',
		'score',
		'lock',
		'area_name',
		'question_title_1',
		'question_title_2',
		'question_title_3',
		'question_answer_1',
		'question_answer_2',
		'question_answer_3',
		'is_question_validate',
		'payword',
		'payword_key',
		'permission',
		'is_wx_pay',
		'wx_pay_qrcode',
		'is_alipay',
		'alipay_qrcode',
		'description',
		'blog_url',
		'twitter_url',
		'zhihu_url',
		'weibo_url',
		'gender',
		'attention_num',
		'fans_num',
	];

	public function pam()
	{
		return $this->belongsTo(PamAccount::class, 'account_id', 'id');
	}

	/**
	 * 资金余额
	 * @param $account_id
	 * @return float
	 */
	public static function money($account_id)
	{
		return (float) self::where('account_id', $account_id)->value('money');
	}

	/**
	 * 根据用户 id 检测支付密码是否正确
	 * @param $account_id
	 * @param $payword
	 * @return bool
	 */
	public static function checkPayword($account_id, $payword)
	{
		$account = PamAccount::info($account_id, true);
		$regUnix = strtotime($account['created_at']);

		return $account['front']['payword'] == self::genPayword($payword, $regUnix, $account['front']['payword_key']);
	}

	/**
	 * 生成账户密码
	 * @param string $ori_payword 原始密码
	 * @param string $reg_unix    注册时间 unix 时间戳
	 * @param string $random_key  六位随机值
	 * @return string
	 */
	public static function genPayword($ori_payword, $reg_unix, $random_key)
	{
		return md5(sha1($ori_payword . $reg_unix) . $random_key);
	}

	/**
	 * 更改支付密码
	 * @param        $account_id
	 * @param string $newPayword 新支付密码
	 * @return bool
	 */
	public static function changePayword($account_id, $newPayword)
	{
		$pam          = PamAccount::info($account_id);
		$key          = Str::random(6);
		$regTime      = strtotime($pam['created_at']);
		$cryptPayword = self::genPayword($newPayword, $regTime, $key);
		self::where('account_id', $account_id)->update([
			'payword'     => $cryptPayword,
			'payword_key' => $key,
		]);

		return true;
	}

	/**
	 * 实名认证状态
	 * @param null $key
	 * @return array|mixed|string
	 */
	public static function kvTruenameStatus($key = null)
	{
		$desc = [
			self::TRUENAME_STATUS_NONE   => '未提交认证资料',
			self::TRUENAME_STATUS_WAIT   => '已提交, 等待审核',
			self::TRUENAME_STATUS_PASSED => '审核通过',
			self::TRUENAME_STATUS_FAILED => '审核失败',
		];

		return !is_null($key)
			? isset($desc[$key]) ? $desc[$key] : ''
			: $desc;
	}

	public static function kvGender($key = null)
	{
		$desc = [
			self::GENDER_SECRET => '保密',
			self::GENDER_MALE   => '男',
			self::GENDER_FEMALE => '女',
		];

		return kv($desc, $key);
	}

	/**
	 * 检测邮件code 是否可用
	 * @param $account_id
	 * @param $code
	 * @return bool|null
	 */
	public static function checkEmailCodeValid($account_id, $code)
	{
		return self::where('account_id', $account_id)
			->where('v_code', $code)
			->where('v_valid_time', '>', Carbon::now())
			->where('v_type', self::V_TYPE_EMAIL)
			->exists();
	}

	/**
	 * 检查手机代码是否可用
	 * @param $account_id
	 * @param $code
	 * @return bool|null
	 */
	public static function checkMobileCodeValid($account_id, $code)
	{
		return self::where('account_id', $account_id)
			->where('v_code', $code)
			->where('v_valid_time', '>', Carbon::now())
			->where('v_type', self::V_TYPE_MOBILE)
			->exists();
	}

	/**
	 * 验证状态显示
	 * @param null $key
	 * @return array|mixed|string
	 */
	public static function kvValidateStatus($key = null)
	{
		$desc = [
			'Y' => '是',
			'N' => '否',
		];

		return !is_null($key)
			? isset($desc[$key]) ? $desc[$key] : ''
			: $desc;
	}
}
