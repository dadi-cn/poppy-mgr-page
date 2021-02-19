<?php

declare(strict_types = 1);

namespace Poppy\CanalEs\Classes\Canal;


use App\Canal\Message\Message;

class Listener
{
    /**
     * @var Client
     */
    private $canalClient;

    /**
     * Listener constructor.
     * @throws \Exception
     */
    public function __construct()
    {
        $this->canalClient = Client::createClient();
    }

    public function monitor()
    {
        while (true) {
            $message = $this->canalClient->get(config('canal.message_size'));

            if (!$entries = $message->getEntries()) {
                sleep(1);
                continue;
            }

            (new Dispatcher((new Message($entries))->format()))->dispatch();
        }
    }

}