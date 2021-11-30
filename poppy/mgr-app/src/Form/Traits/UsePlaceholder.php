<?php


namespace Poppy\MgrApp\Form\Traits;

trait UsePlaceholder
{

    public function placeholder($ph): self
    {
        $this->setAttribute('placeholder', $ph);
        return $this;
    }
}
