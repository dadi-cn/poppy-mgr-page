<?php

declare(strict_types = 1);

namespace Poppy\CanalEs\Classes;

/**
 * @method property() 获取属性值
 * @method table()    查询的数据表
 * @method formatter() 格式化工具
 * @method index() 格式化工具
 */
class IndexManager
{

    private $config;

    private static $mapper;
    private static $instances;

    private function __construct($config)
    {
        $this->config = $config;
    }

    public function __call($method, $arguments): string
    {
        return $this->config[$method] ?? '';
    }

    /**
     * Canal 服务
     * @return string
     */
    public function destination(): string
    {
        return $this->config['destination'] ?? 'test';
    }

    /**
     * 订阅过滤, 默认所有
     * @return string
     */
    public function filter(): string
    {
        return $this->config['filter'] ?? '.*\\..*';
    }

    /**
     * @param $indexName
     * @return self
     */
    public static function instance($indexName): self
    {
        if (!self::$mapper) {
            self::$mapper = config('poppy.canal-es.mapper');
        }
        if (!isset(self::$instances[$indexName])) {
            $config          = data_get(self::$mapper, $indexName);
            $config['index'] = $indexName;

            self::$instances[$indexName] = new self($config);
        }
        return self::$instances[$indexName];
    }


    /**
     * 获取索引
     * @param string $tableName 表名称 db.table
     * @return int|string|null
     */
    public static function indexFormTable(string $tableName)
    {
        if (!self::$mapper) {
            self::$mapper = config('poppy.canal-es.mapper');
        }
        foreach (self::$mapper as $index => $item) {
            if ($item['table'] === $tableName) {
                return $index;
            }
        }
        return null;
    }

    /**
     * 获取索引
     * @param string $tableName 表名称 db.table
     * @return int|string|null
     */
    public static function formatterFormTable(string $tableName)
    {
        if (!self::$mapper) {
            self::$mapper = config('poppy.canal-es.mapper');
        }
        foreach (self::$mapper as $index => $item) {
            if ($item['table'] === $tableName) {
                return $item['formatter'] ?? '';
            }
        }
        return null;
    }
}