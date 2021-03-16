<?php

namespace Op\Commands;

use DB;
use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Op\Classes\LocalDir;
use Poppy\Framework\Exceptions\ApplicationException;
use Symfony\Component\Process\Process;
use Throwable;

/**
 * 使用命令行生成 api 文档
 */
class MwebCommand extends Command
{

	protected $signature = 'op:mweb
		{file : File}
		{title : File Title}
	';

	protected $description = 'Move file to aim files';

	/**
	 * Execute the console command.
	 */
	public function handle()
	{
		$file  = $this->argument('file');
		$title = $this->argument('title');

		// /Users/duoli/Documents/mweb/docs/15884337042037.md
		try {
			$oriRoot     = dirname($file);
			$oriMedia    = $oriRoot . '/media';
			$fileContent = app('files')->get($file);
			$this->info('Mweb : Read File : ' . $file);
			$this->info('Mweb : Title : ' . $title);
			$uuid = pathinfo($file, PATHINFO_FILENAME);
			$this->info('Mweb : Get File UUid : ' . $uuid);
			$article = DB::connection('mweb')->table('article')->where('uuid', $uuid)->first();
			if (!$article) {
				throw new ApplicationException('Mweb file uuid Error');
			}
			$this->info('Mweb : Get File Html Name Form MainLib.db : ' . $article->docName);
			// path format : lang-javascript:folder/of/path/file.md
			$aimName     = $article->docName;
			$folderAlias = Str::before($aimName, ':');
			$path        = Str::after($aimName, ':');
			if (!$folderAlias) {
				throw new ApplicationException('Html file format error! no alias in path');
			}

			// copy file
			$aimRoot = LocalDir::alias($folderAlias);

			$type = 'absolute';
			if (in_array($folderAlias, ['wuli-doc', 'dadi-doc'])) {
				$type = 'relative';
			}
			if (!$aimRoot) {
				throw new ApplicationException('No Alias in aliases set');
			}
			$aimMediaRoot = $type === 'relative' ? $aimRoot . '/' . dirname($path) . '/media' : $aimRoot . '/_static/images/media';
			$aimPath      = $aimRoot . '/' . $path;
			if (!app('files')->exists(dirname($aimPath))) {
				app('files')->makeDirectory(dirname($aimPath), 0755, true, true);
			}

			// copy files if exists
			$oriFileMedia = $oriMedia . '/' . $uuid;

			// delete exists
			$aimFileMedia = $aimMediaRoot . '/' . $uuid;
			if (file_exists($aimFileMedia)) {
				app('files')->deleteDirectory($aimFileMedia);
				$this->info('Mweb : Delete Aim Folder : ' . $aimFileMedia);
			}

			// copy and replace
			if (file_exists($oriFileMedia)) {
				app('files')->copyDirectory($oriFileMedia, $aimFileMedia);
				$this->info('Mweb : Files Copy Success. From : ' . $oriFileMedia . ', To: ' . $aimFileMedia);
			}
			else {
				$this->info('Mweb : No Relation files! ');
			}

			// match un-exist folder file
			if (preg_match_all('/\(media\/(?<uuid>\d+)\/(?<file>.*?)\)/', $fileContent, $matches, PREG_SET_ORDER)) {
				$this->info('Mweb : Files Relation Copy Start.');
				$num = 0;
				foreach ($matches as $match) {
					if ($match['uuid'] !== $uuid) {
						app('files')->copy($oriMedia . '/' . $match['uuid'] . '/' . $match['file'], $aimMediaRoot . '/' . $match['uuid'] . '/' . $match['file']);
						$num++;
					}
				}
				$this->info('Mweb : Files Relation Copy End. Files Num:' . $num);
			}

			// replace file content
			$mediaReplace = $type === 'relative' ? '](./media/' : '](/_static/images/media/';
			$fileContent  = str_replace('](media/', $mediaReplace, $fileContent);
			$this->info('Mweb : Replace media prefix in content ');

			// put file
			$isExist = app('files')->exists($aimRoot . '/' . $path);
			app('files')->put($aimRoot . '/' . $path, $fileContent);
			$this->info('Mweb : Write Content to Aim File : ' . $aimRoot . '/' . $path . ' ');

			// auto commit
			$shell = '/Users/duoli/Documents/workbench/l.dadi/op/project/dadi.sh' . ' auto-commit ' . $aimRoot . ' \'' . ($isExist ? '修改 : ' : '新增 : ') . $title . '\'';
			$this->info('Mweb : Auto Commit : ' . escapeshellcmd($shell));
			$process = new Process($shell);
			$process->start();
			$process->wait(function ($type, $buffer) {
				if (Process::ERR === $type) {
					$this->error('ERR > ' . $buffer);
				}
			});
		} catch (Throwable $e) {
			$this->error('Meb : ERROR : ' . $e->getMessage());
		}
	}
}