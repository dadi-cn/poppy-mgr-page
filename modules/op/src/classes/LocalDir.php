<?php

namespace Op\Classes;

/**
 * 本地 Dir 映射
 */
class LocalDir
{
	/**
	 * Alias
	 * @param string $dir 目录映射名称
	 * @return string
	 */
	public static function alias($dir)
	{
		$aliases = [
			'lang-javascript' => '/Users/duoli/Documents/workbench/docs/lang-javascript',
			'dev-coder'       => '/Users/duoli/Documents/workbench/docs/dev-coder',
			'lang-php'        => '/Users/duoli/Documents/workbench/docs/lang-php',
			'doc-poppy'       => '/Users/duoli/Documents/workbench/docs/doc-poppy',
			'doc-projects'    => '/Users/duoli/Documents/workbench/docs/doc-projects',
			'lang-cpp'        => '/Users/duoli/Documents/workbench/docs/lang-cpp',
			'lang-dart'       => '/Users/duoli/Documents/workbench/docs/lang-dart',
			'lang-html'       => '/Users/duoli/Documents/workbench/docs/lang-html',
			'lang-linux'      => '/Users/duoli/Documents/workbench/docs/lang-linux',
			'lang-python'     => '/Users/duoli/Documents/workbench/docs/lang-python',
			'lang-shell'      => '/Users/duoli/Documents/workbench/docs/lang-shell',
			'lang-man'        => '/Users/duoli/Documents/workbench/docs/lang-man',
			'op-modify'       => '/Users/duoli/Documents/workbench/docs/op-modify',
			'op-secret'       => '/Users/duoli/Documents/workbench/docs/op-secret',
			'doc-dadi'        => '/Users/duoli/Documents/workbench/l.dadi/dadi-doc',
			'wuli-doc'        => '/Users/duoli/Documents/workbench/docs/wulicode-docs',
			'dadi-doc'        => '/Users/duoli/Documents/workbench/docs/dadi-docs',
		];
		return $aliases[$dir] ?? '';
	}
}