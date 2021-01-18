<?php namespace Rds\Models;

/**
 * App\Models\PamBind
 * @property int        $account_id
 * @property string         $qq_key      QQ 绑定ID
 * @property string         $qq_union_id QQ Union ID
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $created_at
 */
class UserBind extends \Eloquent
{
	protected $table = 'user_bind';

	protected $primaryKey = 'account_id';

	protected $fillable = [
		'account_id',
		'qq_key',
		'qq_union_id',
	];

	/**
	 * 绑定社会化组件
	 * @param      $account_id
	 * @param      $field
	 * @param      $key
	 * @param null $head_pic
	 * @return bool
	 */
	public static function socialite($account_id, $field, $key, $head_pic = null)
	{
		if ($head_pic) {
			/* 拖慢性能. 暂时不处理
			$img         = \Image::make($head_pic);
			$destination = 'uploads/avatar/' . $account_id . '.png';
			$img->save(public_path($destination));
			$head_pic = $destination;
			 */
			self::where('account_id', $account_id)->update([
				'head_pic' => $head_pic,
			]);
		}
		if (self::where('account_id', $account_id)->first()) {
			self::where('account_id', $account_id)->update([$field => $key]);
		}
		else {
			self::create([
				'account_id' => $account_id,
				$field       => $key,
			]);
		}

		return true;
	}
}
