<?php namespace Op\Classes\ImageGenerator;

use Intervention\Image\ImageManager;

/**
 * 图形生成器
 */
abstract class BaseImageGenerator
{
	protected $manager;

	public function __construct()
	{
		$this->manager = new ImageManager();
	}

    public function gen(int $width, int $height, string $text, $bg = '#282828', $fc = '#eae0d0')
	{
	}
}
