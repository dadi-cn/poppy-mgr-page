<?php

namespace Php\Listeners\EventRun;

use Log;
use Php\Events\EventRunEvent;
use Poppy\Framework\Application\Event;

class ThirdListener
{
	/**
	 * Handle the event.
	 *
	 * @param Event|EventRunEvent $event
	 * @return void
	 */
	public function handle(EventRunEvent $event)
	{
		Log::debug(sys_mark($event, __CLASS__, 'third'));
	}
}
