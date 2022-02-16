<?php

namespace Poppy\MgrApp\Form\Traits;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Arr;

trait UseOptions
{

    /**
     * Set options.
     *
     * @param array|callable|string $options
     * @return $this
     */
    public function options($options = []): self
    {
        if ($options instanceof Arrayable) {
            $options = $options->toArray();
        }


        $first = Arr::first($options);
        $group = false;
        if (is_array($first) && count($first['options'] ?? [])) {
            // group use at select(分组)
            $group = true;
        }

        $formatOptions = [];
        if (is_scalar($first)) {
            foreach ($options as $key => $option) {
                $formatOptions[] = [
                    'value' => $key,
                    'label' => $option
                ];
            }
            $options = $formatOptions;
        }

        $this->setAttribute('options', $options);
        $this->setAttribute('group', $group);
        return $this;
    }
}
