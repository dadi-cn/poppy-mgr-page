<?php

namespace Demo\Http\Forms\Web;

use Poppy\Framework\Classes\Resp;
use Poppy\MgrApp\Widgets\FormWidget;

class FormFieldDateEstablish extends FormWidget
{

    public function handle()
    {
        $message = print_r(input(), true);
        return Resp::success($message);
    }

    /**
     */
    public function data(): array
    {
        return [
            'id'      => 5,
            'default' => '',
        ];
    }

    public function form()
    {
        $this->year('year', '年份');
        $this->month('month', '月份');
        $this->date('default', 'Date:默认');
        $this->date('disabled', 'Date:禁用')->disabled();
        $this->date('placeholder', 'Date:占位符')->placeholder('Date占位符');
        $this->datetime('datetime', 'Datetime');
        $this->time('time', 'Time');
        $this->dateRange('dates', '日期范围');
        $this->dateRange('dates-range', '日期范围(占位符)')->placeholders('Start', 'End');
        $this->monthRange('monthes', '月份范围');
        $this->monthRange('monthes-range', '月份范围(占位符)')->placeholders('Start', 'End');
        $this->datetimeRange('datetime-range', 'Datetime(Range)');
        $this->timeRange('time-range', 'Time(Range)');
    }
}
