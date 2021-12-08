<?php

namespace Php\Events;

use Illuminate\Queue\SerializesModels;
use Php\Models\PhpDemo;
use Poppy\Framework\Application\Event;

class JobSmEvent extends Event
{
    use SerializesModels;

    public PhpDemo $demo;

    public function __construct($demo)
    {
        $this->demo = $demo;
    }
}
