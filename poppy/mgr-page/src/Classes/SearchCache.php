<?php namespace Poppy\MgrPage\Classes;

use Poppy\Core\Redis\RdsDb;

/**
 * 缓存
 */
class SearchCache
{

    private const KEY = 'py-mgr-page:search-py';

    /**
     * @param string $text
     * @return string
     */
    public static function py(string $text)
    {
        $Rds = new RdsDb();
        if (function_exists('ext_pinyin_abbr')) {
            if ($py = $Rds->hget(self::KEY, $text)) {
                return $py;
            }
            /** @var  $pinYin */
            $py = ext_pinyin_abbr($text);
            $Rds->hset(self::KEY, $text, $py);
            return $py;
        }
        return '';
    }
}
