<?php

namespace Poppy\SensitiveWord\Classes\Sensitive;

use Poppy\Core\Redis\RdsDb;
use Poppy\SensitiveWord\Classes\PySensitiveWordDef;
use Poppy\SensitiveWord\Models\PySensitiveWord;
use Throwable;

/**
 * 敏感词字典
 */
class SensitiveDirectory
{
    /**
     * @var RdsDb $cache
     */
    private $cache;

    /**
     * SensitiveDirectory constructor.
     */
    public function __construct()
    {
        $this->cache = new RdsDb();
    }

    /**
     * @return mixed|SensitiveWords|null
     */
    public function getDirectory()
    {
        $directory = self::unSerializeDirectory($this->cache->get(PySensitiveWordDef::ckOriDict()));

        if (!$directory) {
            $directory = $this->buildDirectory();
        }

        return $directory;
    }

    /**
     * 构建敏感词字典
     * @return SensitiveWords|null
     */
    public function buildDirectory(): ?SensitiveWords
    {
        try {
            $words     = PySensitiveWord::pluck('word')->toArray();
            $directory = SensitiveWords::instance()->setTree($words);
        } catch (Throwable $e) {
            $directory = null;
        }

        $this->cache->set(PySensitiveWordDef::ckOriDict(), self::serializeDirectory($directory));

        return $directory;
    }

    /**
     * 序列化字典
     * @param $directory
     * @return string
     */
    private static function serializeDirectory($directory): string
    {
        return serialize($directory);
    }

    /**
     * @param $string
     * @return mixed|null
     */
    private static function unSerializeDirectory($string)
    {
        if (!$string) {
            return null;
        }

        try {
            return unserialize($string);
        } catch (Throwable $e) {
            return null;
        }
    }
}