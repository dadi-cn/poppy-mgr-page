<?php

namespace Misc\Models;

use Illuminate\Database\Eloquent\Model;

/**
 *
 */
class InvQuestionUser extends Model
{
	protected $connection = 'mysql-inv';

	protected $table = 'inv_question_njgj_userinfo';

	protected $fillable = [];
}
