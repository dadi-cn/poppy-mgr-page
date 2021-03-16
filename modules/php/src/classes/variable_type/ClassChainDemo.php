<?php

namespace Php\Classes\VariableType;

class ClassChainDemo
{
	private $name;

	public function setName($name)
	{
		$this->name = $name;
		return $this;
	}

	public function name()
	{
		return $this->name;
	}
}
