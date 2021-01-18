<?php namespace Rds\Models;

/**
 *
 * @mixin \Eloquent
 * @property int $site_id
 * @property int $cat_id
 */
class SiteRelCat extends \Eloquent
{
	protected $table = 'site_rel_cat';

	public $timestamps = false;

	protected $fillable = [
		'site_id',
		'cat_id',
	];
}
