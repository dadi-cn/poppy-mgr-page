<?php

namespace Site\Tests\Excel\Exports;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Site\Models\CsdnUser;

/**
 * 充值流水汇总导出sheet
 */
class AllPwdSheet implements ShouldQueue, FromQuery, WithHeadings, WithTitle
{
	use Queueable, Exportable;

	private $title = '密码数据';

	private $fileName = '密码数据.xlsx';

	/**
	 * 查询条件
	 * @var array
	 */
	private $input = [];

	private $type;

	private $type_desc;

	/**
	 * FinanceOrderExport constructor.
	 * @param $input
	 */
	public function __construct($input)
	{
		$this->input = $input;
		$this->type  = sys_get($input, 'type', 'money');

		$arr_types = [
			'money'       => '伙币流水',
			'diamond'     => '钻石流水',
			'ios_money'   => 'ios伙币流水',
			'ios_diamond' => 'ios钻石流水',
			'refund'      => '订单退款流水',
		];

		$this->type_desc = $arr_types[$this->type];
	}

	public function query()
	{
		$Db = (new CsdnUser());
		$Db->orderByDesc('id');
		return $Db;
	}

	/**
	 * @return array
	 */
	public function headings(): array
	{
		return [
			'ID',
			'Name',
			'Password',
			'Mail',
		];
	}

	/**
	 * @return string
	 */
	public function title(): string
	{
		return $this->type_desc;
	}

}