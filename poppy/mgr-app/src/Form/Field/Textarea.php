<?php

namespace Poppy\MgrApp\Form\Field;

use Poppy\MgrApp\Form\FormItem;

class Textarea extends FormItem
{
	/**
	 * Default rows of textarea.
	 *
	 * @var int
	 */
	protected $rows = 5;

	/**
	 * Set rows of textarea.
	 *
	 * @param int $rows
	 *
	 * @return $this
	 */
	public function rows($rows = 5)
	{
		$this->rows = $rows;

		return $this;
	}

	/**
	 * @inheritDoc
	 */
	public function render()
	{
		if (is_array($this->value)) {
			$this->value = json_encode($this->value, JSON_PRETTY_PRINT);
		}

		return parent::render()->with(['rows' => $this->rows]);
	}
}
