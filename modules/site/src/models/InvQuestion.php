<?php namespace Site\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;

/**
 *
 * @mixin Eloquent
 */
class InvQuestion extends Eloquent
{
	protected $connection = 'mysql-inv';

	protected $table = 'inv_question_njgj';

	protected $fillable = [];
}
