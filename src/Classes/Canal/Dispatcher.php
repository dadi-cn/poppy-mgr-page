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
     * Dispatch constructor.
     * @param Message $messages
     */
    public function __construct(Message $messages)
    {
        $this->prepare  = new Prepare($messages);
        $this->document = new Document();
    }

    public function dispatch()
    {
        $this->document->bulk($this->prepare->records());
    }
}