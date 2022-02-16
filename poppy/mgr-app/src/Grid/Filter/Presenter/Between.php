<?php

namespace Poppy\MgrApp\Grid\Filter\Presenter;

class Between extends Presenter
{
    /**
     * @var string
     */
    protected string $type = 'between';


    public function startPh($ph): self
    {
        $this->setAttribute('start_placeholder', $ph);
        return $this;
    }

    public function endPh($ph): self
    {
        $this->setAttribute('end_placeholder', $ph);
        return $this;
    }
}
