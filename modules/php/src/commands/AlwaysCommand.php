<?php

namespace Php\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Process\Process;

/**
 * 持久化获取数据
 */
class AlwaysCommand extends Command
{

    protected $signature = 'php:always';

    protected $description = 'Generate Exam Document';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $process = new Process(['php', 'artisan', 'php:exam', 'function']);
        while (true) {
            $this->output->write(Carbon::now());
            $rand = random_int(3, 12);
            if ($rand > 10) {
                $this->info('sleep 2:' . $rand);
                sleep(5);
            }

            if ($rand < 5) {
                $this->info('sleep 1:' . $rand);
                sleep(1);
            }
            // get taobao

            // empty => sleep (5)

            // data => sleep(2)
            $process->run(function ($type, $line) {
                $this->output->write($type . $line);
            });

            // Once we have run the job we'll go check if the memory limit has been exceeded
            // for the script. If it has, we will kill this script so the process manager
            // will restart this with a clean slate of memory automatically on exiting.
            if ($this->memoryExceeded(64)) {
                $this->stop();
            }
        }
    }

    /**
     * Determine if the memory limit has been exceeded.
     *
     * @param int $memoryLimit
     * @return bool
     */
    public function memoryExceeded($memoryLimit)
    {
        $this->output->writeln(memory_get_usage(true));
        return (memory_get_usage(true) / 1024 / 1024) >= $memoryLimit;
    }

    /**
     * Stop listening and bail out of the script.
     *
     * @return void
     */
    public function stop()
    {
        die;
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