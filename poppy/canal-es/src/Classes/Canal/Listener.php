<?php

declare(strict_types = 1);

namespace Poppy\CanalEs\Classes\Canal;

use Exception;
use Poppy\CanalEs\Classes\Canal\Message\Message;
use Poppy\Framework\Classes\Traits\AppTrait;
use Throwable;

class Listener
{
    use AppTrait;
    /**
     * @var Client
     */
    private $canalClient;

    private $output;

    /**
     * Listener constructor.
     * @param $index
     * @throws Exception
     */
    public function __construct($index)
    {
        $this->canalClient = Client::createClient($index);
    }

    public function setOutput($output): Listener
    {
        $this->output = $output;
        return $this;
    }

    public function monitor()
    {
        try {
            while (true) {
                $message = $this->canalClient->get(config('poppy.canal-es.canal.message_size'));

                if (!$entries = $message->getEntries()) {
                    sleep(1);
                    continue;
                }

                (new Dispatcher((new Message($entries))->format(), $this->output))
                    ->dispatch();
            }
        } catch (Throwable $e) {
            return $this->setError($e->getMessage());
        }
    }
}