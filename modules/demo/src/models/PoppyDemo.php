<?php

namespace Demo\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Poppy\System\Models\PamAccount;

/**
 * \Poppy\PoppyCoreDemo
 *
 * @property int                  $id
 * @property int                  $is_open 是否开启
 * @property Carbon|null          $created_at
 * @property Carbon|null          $updated_at
 * @property string               $style
 * @property int|null             $status
 * @property string|null          $desc
 * @property string|null          $email
 * @property string|null          $title
 * @property int                  $list_order
 * @property string|null          $username
 * @property string|null          $file
 * @property string|null          $last_name
 * @property string|null          $link
 * @property string|null          $image
 * @property int|null             $progress
 * @property int|null             $trashed
 * @property string|null          $content
 * @property string|null          $b
 * @property int|null             $account_id
 * @property string|null          $loading
 * @property string|null          $first_name
 * @property string|null          $date
 * @property string|null          $day
 * @property string|null          $year
 * @property string|null          $month
 * @property int|null             $is_enable
 * @property string|null          $op_group
 * @property string|null          $type
 * @property string|null          $handle
 * @property string|null          $order_able
 * @property string|null          $modal
 * @property string|null          $prefix
 * @property string|null          $suffix
 * @property-read PamAccount|null $pam
 * @method static Builder|PoppyDemo newModelQuery()
 * @method static Builder|PoppyDemo newQuery()
 * @method static Builder|PoppyDemo query()
 * @mixin Eloquent
 */
class PoppyDemo extends Model
{
    // change tablename
    protected $table    = 'poppy_demo';

    protected $fillable = [
        // fillable
    ];

    public function pam()
    {
        return $this->hasOne(PamAccount::class, 'id', 'account_id');
    }
}