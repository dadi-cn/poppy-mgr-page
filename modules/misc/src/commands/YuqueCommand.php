<?php

namespace Misc\Commands;

use Illuminate\Console\Command;


class YuqueCommand extends Command
{

    /**
     * The name and signature of the console command.
     * @var string
     */
    protected $signature = 'misc:yuque {type}';

    /**
     * The console command description.
     * @var string
     */
    protected $description = 'system sample schedule';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $type    = $this->argument('type');
        $File    = app('files');
        $content = json_decode($File->get(poppy_path('module.misc', 'resources/conf/php.json')));
        foreach ($content as $con) {
            $slug  = data_get($con, 'slug');
            $title = data_get($con, 'title');

            $fileCon = file_get_contents('https://www.yuque.com/duoli/php/' . $slug . '/markdown?attachment=true&latexcode=false&anchor=false&linebreak=false');
            $con = '# '.$title. PHP_EOL.$fileCon;
            $File->put(poppy_path('module.misc', 'resources/php/'.$slug.'.md'), $con);
        }
    }
}