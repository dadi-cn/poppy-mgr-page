<?php

namespace Php\Commands;

use Illuminate\Console\Command;
use Php\Events\EventRunEvent;
use Php\Events\JobSmEvent;
use Php\Jobs\DeletePhpDemoJob;
use Php\Models\PhpDemo;
use Poppy\Framework\Exceptions\FakerException;
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
     * @throws FakerException
     */
    public function handle()
    {
        $type = $this->argument('type');
        switch ($type) {
            case 'event':
                event(new EventRunEvent());
                break;
            case 'job-sm-event':
                $item  = PhpDemo::create([
                    'title' => py_faker()->paragraph(1),
                ]);
                sys_debug('php', __CLASS__, "id: {$item->id}, title:{$item->title}");
                event(new JobSmEvent($item));
                break;
            case 'job-sm':
                $item  = PhpDemo::create([
                    'title' => py_faker()->paragraph(1),
                ]);
                $queue = config('queue.default');
                sys_debug('php', __CLASS__, "id: {$item->id}, title:{$item->title}, queue:{$queue}");
                dispatch(new DeletePhpDemoJob($item));
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