<?php

declare(strict_types = 1);

namespace Php\Classes\EsFormatter;

use Carbon\Carbon;
use Poppy\CanalEs\Classes\Es\DocumentFormatter;
use Throwable;

class OrderDocumentFormatter extends DocumentFormatter
{
    private static $formatFields = [
        'locked_at',
        'examine_at',
        'published_at',
        'quashed_at',
        'excepted_at',
        'exception_handled_at',
        'exception_cancel_at',
        'exception_cancelled_at',
        'deleted_at',
        'assigned_at',
        'overed_at',
        'ended_at',
        'handled_at',
        'cancel_applied_at',
        'cancel_rejected_at',
        'cancel_passed_at',
        'cancel_cancelled_at',
        'cancel_handle_at',
        'kf_applied_at',
        'kf_agreed_at',
        'kf_handled_at',
        'kf_done_at',
        'question_at',
        'question_handle_at',
        'refund_at',
        'pt_accept_sync_at',
        'tpl_updated_at',
        'first_published_at',
        'updated_at',
        'created_at',
        'addprice_at',
    ];

    public function format(): array
    {
        return array_merge($this->item, $this->formatDatetime());
    }

    private function formatDatetime()
    {
        $data = [];
        foreach ($this->item as $field => $value) {
            if (!in_array($field, self::$formatFields, false)) {
                continue;
            }
            $data[$field] = $this->convertDatetime($value);
        }

        return $data;
    }

    private function convertDatetime($value)
    {
        if (!$value || $value === '0000-00-00 00:00:00') {
            return null;
        }

        try {
            return Carbon::parse($value)->toDateTimeString();
        } catch (Throwable $e) {
            return null;
        }
    }
}