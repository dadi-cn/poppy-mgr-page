<?php

namespace Rds\Tests;

use Poppy\Core\Redis\RdsDb;
use Poppy\Framework\Application\TestCase;

class RedisBaseTest extends TestCase
{
    /**
     * Redis Client
     * @var RdsDb
     */
    protected $redis;

    public function setUp(): void
    {
        parent::setUp();
        $this->redis = new RdsDb();
    }
}