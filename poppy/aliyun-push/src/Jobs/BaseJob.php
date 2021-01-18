<?php namespace Poppy\AliyunPush\Jobs;

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


    public function __construct($type, $broadcast, $title, $body, $tags, $extra = '')
    {
        $this->type      = $type;
        $this->broadcast = $broadcast;
        $this->title     = $title;
        $this->body      = $body;
        $this->tags      = $tags;
        $this->extra     = $extra;
    }
}