<?php

namespace Poppy\MgrPage\Commands;

use Illuminate\Console\Command;

class MixCommand extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'py-mgr-page:mix';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '将资源文件反向复制到项目中';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $files = [
            'assets/libs/boot/style.css'        => 'poppy/mgr-page/resources/libs/boot/style.css',
            'assets/libs/boot/vendor.min.js'    => 'poppy/mgr-page/resources/libs/boot/vendor.min.js',
            'assets/libs/boot/poppy.mgr.min.js' => 'poppy/mgr-page/resources/libs/boot/poppy.mgr.min.js'
        ];

        collect($files)->each(function ($aim, $ori) {
            app('files')->copy(public_path($ori), base_path($aim));
            $this->info(sys_mark('poppy.mgr-page', __CLASS__, "Copy {$ori} to {$aim} success"));
        });
    }
}