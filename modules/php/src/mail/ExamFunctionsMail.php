<?php namespace Php\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

/**
 * php 函数
 */
class ExamFunctionsMail extends Mailable
{
	use Queueable, SerializesModels;

	/**
	 * @var array 函数
	 */
	public $functions;

	/**
	 * @var array 方法
	 */
	public $methods;

	/**
	 * Create a new message instance.
	 *
	 * @param $exam
	 */
	public function __construct($exam = [])
	{
		$this->functions = $exam['functions'] ?? [];
		$this->methods   = $exam['methods'] ?? [];
	}

	/**
	 * Build the message.
	 *
	 * @return $this
	 */
	public function build()
	{
		return $this->view('system::email.php_functions');
	}
}
