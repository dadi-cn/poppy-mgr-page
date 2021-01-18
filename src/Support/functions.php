<?php

use Carbon\Carbon;
use Illuminate\Cache\TaggableStore;
use Illuminate\Cache\TaggedCache;
use Illuminate\Contracts\Console\Kernel as ConsoleKernelContract;
use Illuminate\Support\Str;
use Poppy\Core\Redis\RdsStore;
use Poppy\Core\Services\Factory\ServiceFactory;
use Poppy\Framework\Classes\Resp;
use Poppy\Framework\Exceptions\ApplicationException;

if (!function_exists('sys_cache')) {
    /**
     * 获取缓存
     * @param string|null $tag 标签, 支持字串, 支持类名
     * @return Cache|TaggedCache
     */
    function sys_cache($tag = null)
    {
        $cache = app('cache');
        if ($tag && ($cache->getStore() instanceof TaggableStore)) {
            if (strpos(trim($tag, '\\'), '\\') !== false) {
                $tag = strtolower(substr($tag, 0, strpos($tag, '\\')));
            }

            return $cache->tags($tag);
        }

        return $cache;
    }
}


if (!function_exists('sys_cacher')) {
    /**
     * 缓存器, 随机秒数缓存器, 不在同一时刻读取值
     * @param string $key
     * @param mixed  $value
     * @param int    $second
     * @return mixed
     */
    function sys_cacher(string $key, $value, $second = 30)
    {
        return RdsStore::seconds($key, $value, $second);
    }
}

if (!function_exists('sys_db')) {
    /**
     * 模型缓存
     * @param string $key 需要支持的缓存
     * @return string
     */
    function sys_db(string $key): string
    {
        static $cache;
        if (!$cache) {
            $cache = sys_cache('py-core')->get('lang.models');
            if (!$cache) {
                app(ConsoleKernelContract::class)->call('core:inspect', [
                    'type' => 'db_seo',
                ]);
                $cache = sys_cache('py-core')->get('lang.models');
            }
        }

        return data_get($cache, $key);
    }
}


if (!function_exists('sys_hook')) {
    /**
     * Hook 调用
     * @param string $id
     * @param array  $params
     * @return mixed
     * @throws ApplicationException
     */
    function sys_hook(string $id, array $params = [])
    {
        return (new ServiceFactory())->parse($id, $params);
    }
}


if (!function_exists('sys_error')) {
    /**
     * alias for \Log::error()
     * @param mixed  $object
     * @param string $class
     * @param string $append
     */
    function sys_error($object, string $class, $append = '')
    {
        app('log')->error(sys_mark($object, $class, $append, true));
    }
}


if (!function_exists('sys_mark')) {
    /**
     * 系统 Debug 标识符, 方便快速进行定位
     * @param string|object $object
     * @param string        $class
     * @param string|array  $append
     * @param bool          $with_time
     * @return string
     */
    function sys_mark($object, string $class, $append = '', $with_time = false)
    {
        $suffix = static function ($string) {
            return trim(substr(strrchr($string, '\\'), 1));
        };

        // fetch do name
        if (is_object($object)) {
            $supports = [
                'event',
            ];
            $doClass  = get_class($object);
            $doName   = $suffix($doClass);
            $isFind   = false;
            $type     = '';
            foreach ($supports as $key) {
                $uf = ucfirst($key);
                if (!$isFind && Str::endsWith($doName, $uf)) {
                    $type   = $uf;
                    $doName = substr($doName, 0, strpos($doName, $uf));
                    $isFind = true;
                    continue;
                }
            }
            if ($type) {
                $doName = $type . ':' . $doName;
            }
        }
        else {
            $doName = $object;
        }

        // class name
        $className = $suffix($class);

        // append data
        $content = '';
        if (is_array($append)) {
            $content = json_encode($append, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        }
        if (is_string($append)) {
            $content = $append;
        }
        if ($append instanceof Resp) {
            $content = $append->getMessage();
        }

        return ($with_time ? Carbon::now()->format('m-d h:i:s') . ' ' : '') . '[' . $doName . '.' . $className . '] ' . $content;
    }
}


if (!function_exists('sys_success')) {
    /**
     * 开发环境下记录成功信息, 便于错误调试
     * @param mixed  $object
     * @param string $class
     * @param string $append
     */
    function sys_success($object, string $class, $append = '')
    {
        if (!is_production() && config('app.debug')) {
            app('log')->info(sys_mark($object, $class, $append, true));
        }
    }
}
