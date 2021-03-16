<?php

namespace Poppy\AliyunPush\Jobs;

use Poppy\AliyunPush\Classes\Config\Config;
use Poppy\Framework\Application\Job;


/**
 * 阿里推送Job @ Ios
 */
abstract class BaseJob extends Job
{
    protected $type;
    protected $broadcast;
    protected $title;
    protected $body;

    protected $tags;
    /**
     * @var mixed|string
     */
    protected $extra;

    /**
     * @var Config|null
     */
    protected $config;


    public function __construct($type, $broadcast, $title, $body, $tags, $extra = '', $config = null)
    {
        $this->type      = $type;
        $this->broadcast = $broadcast;
        $this->title     = $title;
        $this->body      = $body;
        $this->tags      = $tags;
        $this->extra     = $extra;
        $this->config    = $config;
    }
}