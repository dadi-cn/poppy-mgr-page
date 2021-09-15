<?php

namespace Misc\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;

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
 * @mixin Eloquent
 */
class CsdnUser extends Eloquent
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
