<?php

namespace Misc\Tests\Excel\Exports;

use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

/**
 * 充值流水汇总导出
 */
class AllPwdExport implements WithMultipleSheets, Responsable
{
	use Exportable;

	/**
	 * @var array 数据
	 */
	private $input;

	/**
	 * @var string 种类
	 */
	private $sheet;

	/**
	 * FinanceAllChargeExport constructor.
	 * @param $input
	 */
	public function __construct($input)
	{
		$this->input = $input;
	}

	/**
	 * @return array
	 */
	public function sheets(): array
	{
		$sheets = [];
		$input    = $this->input;
		$sheets[] = new AllPwdSheet($input);
		return $sheets;
	}
}