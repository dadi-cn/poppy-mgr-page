<?php

namespace Essay\Classes\Md;

use Parsedown;

class EssayParser extends Parsedown
{
	public $arrayLine = [];

	// Override
	protected function blockHeader($Line)
	{
		// Parse $Line to parent class
		$Block = Parsedown::blockHeader($Line);

		// Set headings
		if (isset($Block['element']['name'])) {
			$Level             = (integer) trim($Block['element']['name'], 'h');
			$this->arrayLine[] = [
				'name'  => $Block['element']['name'],
				'text'  => $Block['element']['text'],
				'level' => $Level,
			];
		}
		return $Block;
	}
}