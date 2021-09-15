<?php

namespace Misc\Models;

use Eloquent;

/**
 *
 * @mixin Eloquent
 */
class InvQuestionOptions extends Eloquent
{
	protected $connection = 'mysql-inv';

	protected $table = 'inv_question_njgj_options';

	protected $fillable = [];
}
