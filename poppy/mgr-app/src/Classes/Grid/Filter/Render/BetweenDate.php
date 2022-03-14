<?php

namespace Poppy\MgrApp\Classes\Grid\Filter\Render;

use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Poppy\MgrApp\Classes\Grid\Filter\Presenter\DateTime;

class BetweenDate extends AbstractFilterItem
{

    public function __construct($column = '', string $label = '')
    {
        parent::__construct($column, $label);
        $this->setPresenter(new DateTime());
    }

    /**
     * Get condition of this filter.
     *
     * @param array $inputs
     *
     * @return mixed
     */
    public function condition(array $inputs)
    {
        if (!Arr::has($inputs, $this->column)) {
            return null;
        }

        $this->value = Arr::get($inputs, $this->column);

        if (!$this->value) {
            return null;
        }

        \Log::debug($this->value);
        $value = array_filter($this->value, function ($val) {
            return $val !== '';
        });

        $start = $value['start'];
        $end   = $value['end'];

        $type = $this->presenter->get('type');
        switch ($type) {
            case 'date':
                $start = Carbon::createFromFormat('Y-m-d', $start)->startOfDay()->toDateTimeString();
                $end   = Carbon::createFromFormat('Y-m-d', $end)->endOfDay()->toDateTimeString();
                break;
            case 'month':
                $start = Carbon::createFromFormat('Y-m', $start)->startOfMonth()->toDateTimeString();
                $end   = Carbon::createFromFormat('Y-m', $end)->endOfMonth()->toDateTimeString();
                break;
            case 'datetime':
                $start = Carbon::parse($start)->toDateTimeString();
                $end   = Carbon::parse($end)->toDateTimeString();
                break;
            default:
                return null;
        }

        return $this->buildCondition([
            [$this->column, '<=', trim($end)],
            [$this->column, '>=', trim($start)],
        ]);
    }
}
