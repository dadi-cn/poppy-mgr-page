<?php

declare(strict_types = 1);

namespace Php\Classes\EsProperty;

use Poppy\CanalEs\Classes\Properties\Property;

class Order extends Property
{

    public function settings(): array
    {
        return [
            'number_of_shards'   => 3,
            'number_of_replicas' => 2,
        ];
    }

    public function properties(): array
    {
        return [
            'id'                    => [
                'type' => 'long',
            ],
            'source_id'             => [
                'type' => 'keyword',
            ],
            'account_id'            => [
                'type' => 'keyword',
            ],
            'parent_id'             => [
                'type' => 'keyword',
            ],
            'order_title'           => [
                'type' => 'keyword',
            ],
            'order_color'           => [
                'type' => 'keyword',
            ],
            'order_get_in_number'   => [
                'type' => 'keyword',
            ],
            'order_get_in_wangwang' => [
                'type' => 'keyword',
            ],
            'order_sub_wangwang'    => [
                'type' => 'keyword',
            ],
            'dailian_type'          => [
                'type' => 'keyword',
            ],
            'order_type'            => [
                'type' => 'keyword',
            ],
            'order_hours'           => [
                'type' => 'integer',
            ],

            'order_status'         => [
                'type' => 'keyword',
            ],
            'is_delete'            => [
                'type' => 'keyword',
            ],
            'order_lock'           => [
                'type' => 'keyword',
            ],
            'is_exception'         => [
                'type' => 'keyword',
            ],
            'is_exception_handled' => [
                'type' => 'keyword',
            ],
            'is_delay'             => [
                'type' => 'keyword',
            ],
            'cancel_type'          => [
                'type' => 'keyword',
            ],
            'kf_status'            => [
                'type' => 'keyword',
            ],
            'cancel_status'        => [
                'type' => 'keyword',
            ],

            'exception_type'   => [
                'type' => 'keyword',
            ],
            'exception_status' => [
                'type' => 'keyword',
            ],
            'game_account'     => [
                'type' => 'keyword',
            ],

            'game_actor'      => [
                'type' => 'keyword',
            ],
            'game_id'         => [
                'type' => 'keyword',
            ],
            'server_id'       => [
                'type' => 'keyword',
            ],
            'type_id'         => [
                'type' => 'keyword',
            ],
            'publish_id'      => [
                'type' => 'keyword',
            ],
            'actor_tag_note'  => [
                'type'            => 'text',
                'analyzer'        => 'ik_smart',
                'search_analyzer' => 'ik_smart',
            ],
            'duty_account_id' => [
                'type' => 'keyword',
            ],
            'locked_at'       => [
                'type'   => 'date',
                'format' => 'yyyy-MM-dd HH:mm:ss',
            ],
            'examine_at'      => [
                'type'   => 'date',
                'format' => 'yyyy-MM-dd HH:mm:ss',
            ],
            'published_at'    => [
                'type'   => 'date',
                'format' => 'yyyy-MM-dd HH:mm:ss',
            ],

            'assigned_at' => [
                'type'   => 'date',
                'format' => 'yyyy-MM-dd HH:mm:ss',
            ],

            'ended_at' => [
                'type'   => 'date',
                'format' => 'yyyy-MM-dd HH:mm:ss',
            ],

            'refund_at' => [
                'type'   => 'date',
                'format' => 'yyyy-MM-dd HH:mm:ss',
            ],

            'accept_order_no' => [
                'type' => 'keyword',
            ],
            'accept_platform' => [
                'type' => 'keyword',
            ],

            'pt_accept_sync_at' => [
                'type'   => 'date',
                'format' => 'yyyy-MM-dd HH:mm:ss',
            ],
            'is_question'       => [
                'type' => 'keyword',
            ],

            'question_status'    => [
                'type' => 'keyword',
            ],
            'employee_publish'   => [
                'type' => 'keyword',
            ],
            'employee'           => [
                'type' => 'keyword',
            ],
            'rel_order_id'       => [
                'type' => 'keyword',
            ],
            'create_type'        => [
                'type' => 'keyword',
            ],
            'mark_id'            => [
                'type' => 'keyword',
            ],
            'updated_at'         => [
                'type'   => 'date',
                'format' => 'yyyy-MM-dd HH:mm:ss',
            ],
            'created_at'         => [
                'type'   => 'date',
                'format' => 'yyyy-MM-dd HH:mm:ss',
            ],
            'order_settle'       => [
                'type' => 'keyword',
            ],
            'is_message'         => [
                'type' => 'keyword',
            ],
            'question_at'        => [
                'type'   => 'date',
                'format' => 'yyyy-MM-dd HH:mm:ss',
            ],
            'cancel_applied_at'  => [
                'type'   => 'date',
                'format' => 'yyyy-MM-dd HH:mm:ss',
            ],
            'excepted_at'        => [
                'type'   => 'date',
                'format' => 'yyyy-MM-dd HH:mm:ss',
            ],
            'kf_applied_at'      => [
                'type'   => 'date',
                'format' => 'yyyy-MM-dd HH:mm:ss',
            ],
            'cancel_passed_at'   => [
                'type'   => 'date',
                'format' => 'yyyy-MM-dd HH:mm:ss',
            ],
            'kf_done_at'         => [
                'type'   => 'date',
                'format' => 'yyyy-MM-dd HH:mm:ss',
            ],
            'cancel_rejected_at' => [
                'type'   => 'date',
                'format' => 'yyyy-MM-dd HH:mm:ss',
            ],

        ];
    }
}