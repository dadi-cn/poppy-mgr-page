<?php

declare(strict_types = 1);

namespace Poppy\CanalEs\Classes\Canal;


use Poppy\CanalEs\Classes\Canal\Message\Message;
use Poppy\CanalEs\Classes\Canal\Message\Prepare;
use Poppy\CanalEs\Classes\Es\Document;

class Dispatcher
{
    /**
     * @var Prepare
     */
    private $prepare;
    /**
     * @var Document
     */
    private $document;


    /**
     * 回调输出
     * @var callable
     */
    private $output;

    /**
     * Dispatch constructor.
     * @param Message       $messages
     * @param callable|null $output 输出
     */
    public function __construct(Message $messages, callable $output = null)
    {
        $this->prepare  = new Prepare($messages);
        $this->document = new Document();
        $this->output   = $output;
    }


    public function dispatch()
    {
        $output = $this->output;
        if ($records = $this->prepare->records()) {
            $this->document->bulk($records);
            $output && $output(sys_mark('canal', __CLASS__, 'Records `' . count($records) . '` sync to Es'));
        }
        else {
            $output && $output(sys_mark('canal', __CLASS__, 'No Records sync to Es'));
        }
    }
}