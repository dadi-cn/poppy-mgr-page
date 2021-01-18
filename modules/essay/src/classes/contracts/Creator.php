<?php namespace Essay\Classes\Contracts;

interface Creator
{
	public function creatorFail($error);

	public function creatorSuccess($model);
}