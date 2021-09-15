<?php

namespace Poppy\System\Tests\Action;

use Poppy\System\Tests\Base\SystemTestCase;
use Misc\Tests\Excel\Exports\AllPwdExport;

class CsdnExportTest extends SystemTestCase
{
	public function testPwd(): bool
	{
		(new AllPwdExport([]))->store('./default.xls');
	}
}
