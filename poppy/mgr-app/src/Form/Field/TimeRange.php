<?php

namespace Poppy\MgrApp\Form\Field;

class TimeRange extends Time
{
	public function render()
	{
		$this->options([
			'range' => true,
		]);
		return parent::render();
	}
}
