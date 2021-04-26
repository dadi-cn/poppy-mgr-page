<?php
/*
 * This is NOT a Free software.
 * When you have some Question or Advice can contact Me.
 * @author     Duoli <zhaody901@126.com>
 * @copyright  Copyright (c) 2013-2021 Poppy Team
 */

use Poppy\SensitiveWord\Classes\Sensitive\SensitiveDirectory;
use Poppy\SensitiveWord\Classes\Sensitive\SensitiveWords;

if (!function_exists('words_filter')) {
    /**
     * 词汇过滤
     * @param string $words  词汇
     * @param string $action 动作
     * @return mixed
     */
    function words_filter(string $words, $action = SensitiveWords::TYPE_CHECK)
    {
        /** @var SensitiveWords $Sensitive */
        static $Sensitive = null;

        if (!$Sensitive) {
            $Sensitive = (new SensitiveDirectory())->getDirectory();
        }

        $isIllegal = false;
        if ($Sensitive) {
            if ($action !== SensitiveWords::TYPE_CHECK) {
                $Sensitive->setSearchAllIllegal(true);
            }
            $isIllegal = $Sensitive->illegal($words);
        }

        switch ($action) {
            default:
            case SensitiveWords::TYPE_CHECK:
                return !$isIllegal; // 非法返回false
            case SensitiveWords::TYPE_WORDS:
                return $Sensitive ? $Sensitive->getIllegalWords() : [];
            case SensitiveWords::TYPE_REPLACE:
                return $Sensitive ? $Sensitive->replaceIllegalWords() : [];
        }
    }
}