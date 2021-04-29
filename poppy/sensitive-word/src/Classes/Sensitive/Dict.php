<?php

namespace Poppy\SensitiveWord\Classes\Sensitive;

use Poppy\SensitiveWord\Classes\PySensitiveWordDef;
use Poppy\SensitiveWord\Models\SysSensitiveWord;
use Throwable;

/**
 * 敏感词字典
 */
class Dict
{

    /**
     * @return mixed|Words|null
     */
    public function getDirectory()
    {
        $directory = sys_cache('py-sensitive-word')->get(PySensitiveWordDef::ckDict());

        if (!$directory) {
            $directory = $this->build();
        }

        return $directory;
    }

    /**
     * 构建敏感词字典
     * @return Words|null
     */
    public function build(): ?Words
    {
        try {
            $words     = SysSensitiveWord::pluck('word')->toArray();
            $directory = Words::instance()->setTree($words);
        } catch (Throwable $e) {
            $directory = null;
        }

        sys_cache('py-sensitive-word')->forever(PySensitiveWordDef::ckDict(), $directory);

        return $directory;
    }
}