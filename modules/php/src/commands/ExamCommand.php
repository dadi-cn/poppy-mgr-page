<?php namespace Php\Commands;

use Illuminate\Console\Command;
use Php\Classes\ExamFunctions;
use Symfony\Component\Console\Input\InputArgument;

/**
 * 使用命令行生成 api 文档
 */
class ExamCommand extends Command
{

	protected $signature = 'php:exam
		{type : Document type to run. [php]}
		{--num=30 : Exam function num}
		{--part=1 : 返回生成的文档信息.}
	';

	protected $description = 'Generate Exam Document';

	/**
	 * Execute the console command.
	 */
	public function handle()
	{
		$num  = $this->option('num');
		$part = $this->option('part');
		$type = $this->argument('type');
		switch ($type) {
			case 'function':
				$this->exam($num, $part);
				break;
			case 'function-gen':
				$this->gen($num);

				break;
			default:
				$this->comment('Type is now allowed.Typeis function, function-gen');
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

	/**
	 * php 函数考试
	 * @param int    $num
	 * @param string $part
	 */
	private function exam($num, $part = '')
	{

		if (!$num) {
			$num = 30;
		}

		$exams = (new ExamFunctions())->v2($num, $part);
		$this->table(['Function', 'Description'], $exams);

	}


	private function gen($num)
	{
		(new ExamFunctions())->generate($num);
		$this->info('Gen Function Success.');
	}
}