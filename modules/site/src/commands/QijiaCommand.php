<?php namespace Site\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Log;


class QijiaCommand extends Command
{

	/**
	 * The name and signature of the console command.
	 * @var string
	 */
	protected $signature = 'site:qijia {num}';

	/**
	 * The console command description.
	 * @var string
	 */
	protected $description = 'Gen Excode';

	/**
	 * Execute the console command.
	 */
	public function handle()
	{
		$num = (int) $this->argument('num');
		if ($num <= 0) {
			$this->error('数量不能为 0');
			return;
		}

		$end       = Carbon::createFromFormat('Y-m-d', '2021-01-01')->timestamp;
		$memberDay = 180;
		for ($i = 0; $i < $num; $i++) {
			$str = strtoupper(Str::random());
			Log::debug("INSERT INTO `bkread2.0`.`bk_member_excode`(`id`, `exchange_no`, `level_id`, `days`, `exchange_at`, `expiry_date`, `expiry_user`, `status`, `create_at`) VALUES (null, '{$str}', 1, $memberDay, NULL, $end, NULL, 1, 0);");
		}

	}
}