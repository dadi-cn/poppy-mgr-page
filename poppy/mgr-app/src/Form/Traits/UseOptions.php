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

        $first   = Arr::first($options);
        $complex = false;
        if (is_array($first)) {
            $complex = true;
            // group use at select(分组)
            if (count($first['options'] ?? [])) {
                $complex = 'group';
            }
        }

        $this->setAttribute('options', $options);
        $this->setAttribute('complex', $complex);
        return $this;
    }
}
