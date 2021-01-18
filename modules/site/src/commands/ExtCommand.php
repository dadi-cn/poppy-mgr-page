<?php namespace Site\Commands;

use Illuminate\Console\Command;


class ExtCommand extends Command
{

	/**
	 * The name and signature of the console command.
	 * @var string
	 */
	protected $signature = 'site:ext {type}';

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
		$type = $this->argument('type');
		$File = app('files');
		if ($type === 'alipay') {
			$files = $File->files(resource_path('alipay/request'));
			foreach ($files as $fileInfo) {
				$basename = $fileInfo->getBasename('.php');
				$folder   = '';
				if (preg_match('/[A-Z][a-z]*/', $basename, $match)) {
					$folder = $match[0];
				}
				if (!$folder) {
					continue;
				}
				$newClassName = str_replace($folder, '', $basename);
				$aimPath      = base_path('extensions/ext-alipay/src/OpenApi/' . $folder . '/' . $newClassName . '.php');
				$content      = $File->get($fileInfo->getRealPath());
				$content      = str_replace([
					'<?php',
					'class ' . $basename,
				], [
					'<?php namespace Poppy\Extension\Alipay\OpenApi\\' . $folder . ";\n\n" .
					'use Poppy\Extension\Alipay\OpenApi\Request;' . "\n",
					'class ' . $newClassName . ' extends Request',
				], $content);
				if (!$File->isDirectory(dirname($aimPath))) {
					$File->makeDirectory(dirname($aimPath), 0755, true);
				}

				if (!$File->exists($aimPath)) {
					$File->put($aimPath, $content);
				}
			}
		}
	}
}