<?php

namespace Misc\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * \Site\Models\CsdnUser
 *
 * @property int         $id
 * @property string|null $name
 * @property string|null $pass
 * @property string|null $mail
 * @method static Builder|CsdnUser newModelQuery()
 * @method static Builder|CsdnUser newQuery()
 * @method static Builder|CsdnUser query()
 */
class CsdnUser extends Model
{
	protected $connection = 'mysql-csdn';

	protected $table = 'csdn_user';

	protected $fillable = [
		'id',
		'name',
		'pass',
		'mail',
	];
}
