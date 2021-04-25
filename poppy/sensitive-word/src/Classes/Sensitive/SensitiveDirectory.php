<?php

namespace Poppy\SensitiveWord\Classes\Sensitive;

use Poppy\Core\Redis\RdsDb;
use Site\Classes\FileUpload;
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
        $this->initCache();
    }

    /**
     * @return mixed|SensitiveWords|null
     */
    public function getDirectory()
    {
        $directory = self::unSerializeDirectory($this->cache->get(self::directoryCacheKey()));

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
        $fileUpload = new FileUpload('config');
        $fileUrl    = $fileUpload->getFileUrl('badwords.txt');
        $filePath   = '/config/badwords.txt';
        try {
            copy($fileUrl, resource_path($filePath));
            $file      = resource_path($filePath);
            $directory = SensitiveWords::init()->setTreeByFile($file);
        } catch (Throwable $e) {
            $directory = null;
        }

        $this->cache->set(self::directoryCacheKey(), self::serializeDirectory($directory));

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

    /**
     * 敏感词字典缓存key
     * @return string
     */
    private static function directoryCacheKey()
    {
        return 'sensitive_directory';
    }

    /**
     * 初始化缓存
     */
    private function initCache()
    {
        $this->cache = new RdsDb();
    }
}