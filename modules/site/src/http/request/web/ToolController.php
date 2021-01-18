<?php namespace Site\Http\Request\Web;

use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Poppy\Framework\Classes\Resp;
use Poppy\Framework\Helper\StrHelper;
use Poppy\Framework\Helper\UtilHelper;
use Poppy\System\Http\Request\Web\WebController;

/**
 * 工具
 */
class ToolController extends WebController
{
	/**
	 * @return Factory|JsonResponse|RedirectResponse|Response|Redirector|View
	 */
	public function index()
	{
		return view('site::web.tool.index');
	}

	public function format($type = 'xml')
	{
		if (!in_array($type, ['xml', 'json', 'css', 'sql'])) {
			return Resp::web(Resp::ERROR, '格式化类型不正确');
		}

		return view('site::web.tool.format', [
			'type' => $type,
		]);
	}

	public function mdExtend()
	{
		if (is_post()) {
			$content    = input('content');
			$arrContent = explode(PHP_EOL, $content);

			$transContent = '';
			if (substr_count($content, PHP_EOL) + 1) {
				$lines = [];
				foreach ($arrContent as $k_line => $v_line) {
					$line = trim($v_line);
					if (Str::startsWith($line, '-') || Str::startsWith($line, '–')) {
						$line = str_replace('–', '-', $line);
						$line = PHP_EOL . "`{$line}`";
					}
					elseif (!$line) {
						continue;
					}
					else {
						$line = '    ' . $line;
					}
					$lines[] = $line;
				}
				$transContent = ltrim(implode(PHP_EOL, $lines), PHP_EOL);
			}

			return Resp::web(Resp::SUCCESS, '转化成功', [
				'content'        => $transContent,
				'content_origin' => $content,
			]);
		}

		return view('site::web.tool.md_extend');
	}

	/**
	 * 实体转换
	 * @return mixed
	 */
	public function htmlEntity()
	{
		if (is_post()) {
			$content = input('content');

			return Resp::web(Resp::SUCCESS, '转化成功', [
				'content'        => htmlentities($content),
				'content_origin' => $content,
			]);
		}

		return view('site::web.tool.html_entity');
	}

	/**
	 * 实体转换
	 * @return mixed
	 */
	public function sslKey()
	{
		if (is_post()) {
			$content = input('content');
			if (Str::startsWith($content, '-----')) {
				// remove top/bottom and inline
				$convert = preg_replace('/-----.*?-----/', '', $content);
				$convert = StrHelper::trimSpace($convert);
			}
			else if (!$content) {
				$convert = '';
			}
			else {
				$splits = str_split($content, 64);
				$type   = input('type');
				$start  = '-----BEGIN ' . strtoupper($type) . ' KEY-----';
				$end    = '-----END ' . strtoupper($type) . ' KEY-----';
				array_unshift($splits, $start);
				$splits[] = $end;
				$convert  = implode(PHP_EOL, $splits);
			}
			return Resp::web(Resp::SUCCESS, '转化成功', [
				'content'        => $convert,
				'content_origin' => $content,
			]);
		}

		return view('site::web.tool.ssl_key');
	}

	public function manToMd()
	{
		if (is_post()) {
			$content = input('content');

			// replace **--skip-column-names**, **-N** to `--skip-column-names, -N`
			if (preg_match_all('/\*\*(?<first>.*?)\*\*\, \*\*(?<second>.*?)\*\*/u', $content, $matches, PREG_SET_ORDER)) {
				foreach ($matches as $match) {
					$content = str_replace($match[0], '`' . $match['first'] . ', ' . $match['second'] . '`', $content);
				}
			}

			// replace **mysql** to `mysql`
			if (preg_match_all('/\*\*(?<first>.*?)\*\*/u', $content, $matches, PREG_SET_ORDER)) {
				foreach ($matches as $match) {
					$content = str_replace($match[0], '`' . $match['first'] . '`', $content);
				}
			}

			$lines   = explode(PHP_EOL, $content);
			$fmLines = [];
			$space   = 0;
			foreach ($lines as $line) {

				if (Str::startsWith($line, 'shell> ')) {
					$line = str_replace(
							['`', '*', 'shell> '],
							['', '', '```' . PHP_EOL . '$ '],
							$line
						) . PHP_EOL . '```';
				}

				if (Str::startsWith($line, '• ')) {
					$line = str_replace('*', '', $line);
				}

				if (preg_match_all('/`(.*?)`(\s)?\*(.*?)\*/u', $line, $matches, PREG_SET_ORDER)) {
					foreach ($matches as $match) {
						$line = str_replace($match[0], "`{$match[1]}{$match[2]}{$match[3]}`", $line);
					}
				}

				$line = str_replace(['`*', '``]'], ['', ']'], $line);

				if ($line === '') {
					$space += 1;
					if ($space === 2) {
						$space = 1;
						continue;
					}
				}
				else {
					$space = 0;
				}

				if (!Str::endsWith($line, ['`', '.', '*', ']', ')', '_'])) {
					$line = trim($line, ' ');
				}
				else {
					$line = trim($line, ' ');
					$line .= PHP_EOL;
				}

				if (Str::startsWith($line, ['#', '`'])) {
					$line = PHP_EOL . (Str::endsWith($line, PHP_EOL) ? $line : $line . PHP_EOL);
				}

				$line = str_replace([
					'## NAME', '## Name',
					'## SYNOPSIS', '## Synopsis',
					'## DESCRIPTION', '## Description',
					'## EXAMPLES', '## Examples',
					'## OVERVIEW', '## Overview',
					'## DEFAULTS', '## Defaults',
					'## OPTIONS', '## Options',
					'## ENVIRONMENT', '## Environment',
					'## CAVEATES', '## Caveats',
					'## DIAGNOSTICES', '## Diagnostics',
					'## SEE ALSO', '## See Also',
				], [
					'## 名称', '## 名称',
					'## 命令', '## 命令',
					'## 说明', '## 说明',
					'## 示例', '## 示例',
					'## 概览', '## 概览',
					'## 默认', '## 默认',
					'## 选项', '## 选项',
					'## 环境', '## 环境',
					'## 说明', '## 说明',
					'## 断定', '## 断定',
					'## 相关', '## 相关',
				], $line);

				$fmLines[] = $line;
			}
			return Resp::success('处理成功', [
				'_content' => implode($fmLines),
			]);
		}


		return view('site::web.tool.man_to_md');
	}

	private function parseApidoc($content, &$keys = [], $current_key = '')
	{
		foreach ($content as $_key => $_content) {
			$key = $current_key ? $current_key . '.' . $_key : $_key;
			if (is_int($_content)) {
				$keys[$key] = 'int';
			}
			if (is_string($_content)) {
				$keys[$key] = 'string';
			}
			if (is_array($_content) || is_object($_content)) {
				$keys[$key] = is_object($_content)
					? 'object'
					: 'array';
				$appendKeys = $this->parseApidoc($_content, $keys, $key);
				$keys       = array_merge($keys, $appendKeys);
			}
		}
		$str_replace = [];
		foreach ($keys as $_key => $_content) {
			// object 解析
			if (isset($keys["{$_key}.0"])) {
				$str_replace[] = $_key . '.0';
				unset($keys[$_key]);
			}
			elseif (strpos($_key, '.0') !== false) {
				continue;
			}
			// 去除多层嵌套的
			elseif (preg_match('/\.\d+\.?/u', $_key)) {
				unset($keys[$_key]);
			}
			// 去除 key 是数值
			elseif (preg_match('/^\d+$/u', $_key)) {
				unset($keys[$_key]);
			}
			// 去除以数值开始
			elseif (preg_match('/^\d+\./u', $_key)) {
				unset($keys[$_key]);
			}
		}
		foreach ($keys as $_key => $_content) {
			foreach ($str_replace as $_replace) {
				if ($_key === $_replace) {
					unset($keys[$_key]);
					$keys[str_replace('.0', '', $_key)] = 'object[]';
				}
				elseif (Str::startsWith($_key, $_replace)) {
					unset($keys[$_key]);
					$keys[str_replace('.0', '', $_key)] = $_content;
				}
			}
		}

		return $keys;
	}
}