<?php

namespace Rds\Request\Web;

use Parsedown;
use Poppy\Framework\Classes\Resp;
use Poppy\Framework\Helper\FileHelper;
use Sunra\PhpSimple\HtmlDomParser;
use Poppy\System\Http\Request\Web\WebController;

class FeController extends WebController
{


	public function markdown($dir = null)
	{
		$docDir = resource_path('docs');

		$dirs = $this->getFile()->directories($docDir);
		$dirs = array_map(function ($item) use ($docDir) {
			return str_replace($docDir . '/', '', $item);
		}, $dirs);

		$dir = urldecode($dir) ?: $dirs[0] ?? '/';

		$file      = input('file', 'README.md');
		$data      = [];
		$detail    = $this->markdownDetail($dir, $file);
		$content   = app('files')->get($detail['current']);
		$html      = (new Parsedown())->text($content);
		$html_copy = $html;
		$html_dom  = HtmlDomParser::str_get_html($html_copy);

		$titles   = [];
		$h2_title = '';
		if ($html_dom) {
			foreach ($html_dom->find('h2,h3,table') as $k => $title) {
				if ($title->tag == 'h2') {
					$h2_title                  = $title->plaintext;
					$titles[$title->plaintext] = [];
					$html                      = str_replace('<h2>' . $title->plaintext . '</h2>', '<h2 id="' . md5($title->plaintext) . '">' . $title->plaintext . '</h2>', $html);
				}
				if ($title->tag == 'table') {
					$title->class = 'table';
					$html         = str_replace('<table>', '<table class="table">', $html);
				}
				if ($h2_title && $title->tag == 'h3' && isset($titles[$h2_title])) {
					$titles[$h2_title][] = $title->plaintext;
					$html                = str_replace('<h3>' . $title->plaintext . '</h3>', '<h3 id="' . md5($title->plaintext) . '">' . $title->plaintext . '</h3>', $html);
				}
			}
		}
		$data['html']        = $html;
		$data['detail']      = $detail;
		$data['titles']      = $titles;
		$data['dirs']        = $dirs;
		$data['current_dir'] = $dir;

		return view('slt::fe.markdown', $data);
	}

	public function cache()
	{
		@unlink(app_path('assets/js/global.js'));
		header('location:' . route('index'));
	}

	private function markdownDetail($dir, $file = '')
	{
		$doc_root = resource_path('docs/' . $dir);

		$dirs  = FileHelper::listDir($doc_root);
		$files = [];
		$fb    = '';
		if ($file) {
			$fb = $file;
		}
		foreach ($dirs as $dir) {
			$sub_files = FileHelper::subFile($dir);
			foreach ($sub_files as $k => $v) {
				if (!$fb) {
					$fb = substr($v, strlen($doc_root));
				}
				$sub_files[$k] = substr($v, strlen($doc_root));
			}
			$files[] = [
				'folder' => substr($dir, strlen($doc_root)),
				'files'  => $sub_files,
			];
		}

		$data = [
			'files'   => $files,
			'current' => $doc_root . $fb,
			'fb'      => $fb,
		];

		return $data;
	}

	/**
	 * 首页
	 * @param null $name
	 * @return mixed
	 */
	public function getViews($name = null)
	{
		if (strpos($name, '.') === false) {
			$name = $name . '.index';
		}

		$dir       = str_replace('.', '/', $name);
		$dirs      = explode('/', $dir);
		$project   = $dirs[0];
		$directory = str_replace($project . '/', '', $dir);
		$file      = app_path('project/' . $project . '/views/' . $project . '/' . $directory . '.blade.php');

		if (!file_exists($file)) {
			die('文件' . $file . ' 不存在!');
		}

		return view($name, [
			'project' => $project,
		]);
	}

	public function run()
	{
		$code_html = input('html');
		$code_js   = input('js');
		$code_css  = input('css');
		$site      = config('app.url');
		$html      = <<<HTML
<!doctype html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>演示文档</title>
    <script src="$site/assets/js/require.js"></script>
    <script src="$site/assets/js/config.js"></script>
    <style>$code_css</style>
</head>
<body>
$code_html
<script>$code_js</script>
</body>
</html>
HTML;

		return \Response::make($html);
	}


	private function jsPost($plugin)
	{
		if ($plugin === 'simplemde') {
			return Resp::web(Resp::SUCCESS, '图片上传成功', [
				'json'        => true,
				'success'     => true,
				'url'         => [
					url('modules/slt/images/logo/200x100.png'),
				],
				'destination' => [
					'modules/slt/images/logo/200x100.png',
				],
			]);
		}
	}
}

