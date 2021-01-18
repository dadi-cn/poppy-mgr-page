<?php namespace Essay\Models;

/**
 * @mixin \Eloquent
 * @property int            $id
 * @property int            $prd_id
 * @property int            $prd_version_id
 * @property string         $prd_content
 * @property string         $prd_content_origin
 * @property int            $account_id
 * @property \Carbon\Carbon $created_at
 * @property string         $deleted_at
 * @property \Carbon\Carbon $updated_at
 */
class ArticleVersion extends \Eloquent
{
	protected $table = 'article_version';

	protected $primaryKey = 'id';

	protected $fillable = [
		'prd_id',
		'prd_version_id',
		'prd_content',
		'prd_content_origin',
	];
}
