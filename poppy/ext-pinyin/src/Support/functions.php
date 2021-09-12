<?php

/*
 * This file is part of the overtrue/laravel-pinyin.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

if (!function_exists('ext_pinyin')) {
    /**
     * Get the Pinyin of given string.
     *
     * @param string $string
     * @param int    $option
     *
     * @return array
     */
    function ext_pinyin(string $string, $option = PINYIN_NO_TONE): array
    {
        return app('poppy.ext.pinyin')->convert($string, $option);
    }
}

if (!function_exists('ext_pinyin_abbr')) {
    /**
     * Get the fist letters of given string.
     *
     * @param string $string
     * @param string $delimiter
     *
     * @return string
     */
    function ext_pinyin_abbr(string $string, $delimiter = ''): string
    {
        return app('poppy.ext.pinyin')->abbr($string, $delimiter);
    }
}


if (!function_exists('ext_pinyin_permalink')) {
    /**
     * Get a pinyin permalink from string.
     *
     * @param string $string
     * @param string $delimiter
     *
     * @return string
     */
    function ext_pinyin_permalink(string $string, $delimiter = '-'): string
    {
        return app('poppy.ext.pinyin')->permalink($string, $delimiter);
    }
}


if (!function_exists('ext_pinyin_sentence')) {
    /**
     * Get the fist pinyin and letters of given string.
     *
     * @param string $string
     * @param bool   $tone
     *
     * @return string
     */
    function ext_pinyin_sentence(string $string, $tone = false): string
    {
        return app('poppy.ext.pinyin')->sentence($string, $tone);
    }
}
