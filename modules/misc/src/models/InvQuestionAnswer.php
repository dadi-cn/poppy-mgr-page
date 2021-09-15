<?php

namespace Misc\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;

/**
 *
 * @mixin Eloquent
 */
class InvQuestionAnswer extends Eloquent
{
	protected $connection = 'mysql-inv';

	protected $table = 'inv_question_njgj_answer';

	protected $fillable = [];
}
