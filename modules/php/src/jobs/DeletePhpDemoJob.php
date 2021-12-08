<?php


declare(strict_types = 1);

namespace Php\Jobs;

use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\SerializesModels;
use Php\Models\PhpDemo;


/**
 * 推送Job
 */
class DeletePhpDemoJob implements ShouldQueue
{
    use SerializesModels;

    /**
     * 推送消息
     * @var PhpDemo
     */
    protected PhpDemo $demo;


    public function __construct(PhpDemo $demo)
    {
        $this->demo = $demo;
    }

    /**
     * @return void
     * @throws Exception
     */
    public function handle()
    {
        $this->demo->delete();
        sys_debug('php', __CLASS__, $this->demo->title);
    }
}