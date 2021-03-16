<?php

namespace Site\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;

/**
 *
 * @mixin Eloquent
 */
class InvQuestionUser extends Eloquent
{
	protected $connection = 'mysql-inv';

	protected $table = 'inv_question_njgj_userinfo';

	protected $fillable = [];
}
