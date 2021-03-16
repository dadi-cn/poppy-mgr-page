<?php

namespace Site\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;

/**
 *
 * @mixin Eloquent
 */
class InvQuestionUserlog extends Eloquent
{
	protected $connection = 'mysql-inv';

	protected $table = 'inv_question_njgj_userlog';

	protected $fillable = [];
}
