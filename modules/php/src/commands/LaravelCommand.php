<?php namespace Php\Commands;

use Illuminate\Console\Command;
use Php\Classes\ExamFunctions;
use Php\Events\EventRunEvent;
use Symfony\Component\Console\Input\InputArgument;

/**
 * 使用命令行生成 api 文档
 */
class LaravelCommand extends Command
{

	protected $signature = 'php:laravel
		{type : Document type to run. [php]}
		{--exam_num=30,30 : Exam num, first is function, second is class method.}
	';

	protected $description = 'Generate Exam Document';

	/**
	 * Execute the console command.
	 */
	public function handle()
	{
		$type = $this->argument('type');
		switch ($type) {
			case 'event':
				event(new EventRunEvent());

				break;
			default:
				$this->comment('Type is now allowed.');
				break;
		}
	}


	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return [
			['type', InputArgument::REQUIRED, ' Support Type [exam].'],
		];
	}
}