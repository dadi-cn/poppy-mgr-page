<?php

namespace Poppy\Core\Redis;

use Closure;
use Illuminate\Contracts\Support\Arrayable;
use Poppy\Framework\Exceptions\ApplicationException;
use Poppy\Framework\Helper\UtilHelper;
use Predis\Client;
use Predis\Pipeline\Pipeline;
use Predis\Response\Status;
use stdClass;
use Throwable;

/**
 * 缓存处理
 */
class RdsNative
{
    /**
     * @var Client $redis
     */
    private $redis;

    /**
     * 缓存标签
     * @var string $cacheTag
     */
    private $cacheTag;

    /**
     * CacheHandler constructor.
     * @param array  $config   配置
     * @param string $cacheTag 缓存标签
     */
    public function __construct(array $config, $cacheTag = '')
    {
        $this->redis = new Client($config);

        $this->cacheTag = $cacheTag;
    }

    /**
     * 将字符串值 value 关联到 key, 如果 key 已经持有其他值， SET 就覆写旧值， 无视类型
     * 当 SET 命令对一个带有生存时间（TTL）的键进行设置之后， 该键原有的 TTL 将被清除
     * @param string       $key
     * @param string|array $value
     * @param null|string  $expireResolution 过期策略 EX : 过期时间(秒), PX : 过期时间(毫秒) <br>
     *                                       EX seconds : 秒 <br>
     *                                       PX milliseconds  毫秒 <br>
     *                                       NX -- 不存在则设置 <br>
     *                                       XX -- 存在则设置
     * @param null|int     $expireTTL        过期时间
     * @param null         $flag             设置类型 NX : 不存在则设置, XX : 存在则设置, 这个参数在没有时间设定情况下可以进行前置
     * @return bool
     */
    public function set(string $key, $value, $expireResolution = null, $expireTTL = null, $flag = null): bool
    {
        if (is_array($value)) {
            $value = json_encode($value, JSON_UNESCAPED_UNICODE);
        }

        $arguments    = array_values(func_get_args());
        $arguments[0] = $this->taggedItemKey($key);
        $arguments[1] = $value;

        $result = $this->redis->set(...$arguments);
        if ($result instanceof Status) {
            return true;
        }
        return false;
    }

    /**
     * @param string $key
     * @param bool   $assoc
     * @return string|null|array
     */
    public function get(string $key, $assoc = true)
    {
        $result = $this->redis->get($this->taggedItemKey($key));
        if (UtilHelper::isJson($result)) {
            return json_decode($result, $assoc);
        }
        return $result;
    }

    /**
     * @param $key
     * @return bool
     */
    public function exists($key): bool
    {
        return (bool) $this->redis->exists($this->taggedItemKey($key));
    }

    /**
     * @param $keys
     * @return array
     */
    public function mget($keys)
    {
        return $this->redis->mget($keys);
    }

    /**
     * 设置值并设置过期时间
     * @param string       $key
     * @param int          $seconds
     * @param array|string $value
     * @return bool
     */
    public function setex(string $key, int $seconds, $value): bool
    {
        $res = $this->redis->setex($this->taggedItemKey($key), $seconds, $this->toString($value));
        if ($res instanceof Status) {
            return true;
        }
        return false;
    }

    /**
     * @param $key
     * @param $value
     * @return int
     */
    public function setnx($key, $value)
    {
        return $this->redis->setnx($this->taggedItemKey($key), $value);
    }

    /**
     * @param              $key
     * @param string|array $fields
     * @return int
     */
    public function hdel($key, $fields)
    {
        return $this->redis->hdel($this->taggedItemKey($key), $this->toArray($fields));
    }

    /**
     * @param $key
     * @param $field
     * @return bool
     */
    public function hexists($key, $field)
    {
        return (bool) $this->redis->hexists($this->taggedItemKey($key), $field);
    }

    /**
     * 返回哈希表中给定域的值
     * @param $key
     * @param $field
     * @return string
     */
    public function hget($key, $field)
    {
        return (string) $this->redis->hget($this->taggedItemKey($key), $field);
    }

    /**
     * @param $key
     * @return array
     */
    public function hgetall($key): array
    {
        $infos = $this->redis->hgetall($this->taggedItemKey($key));

        return $this->unserializeResult($infos);
    }

    /**
     * @param                                 $key
     * @param                                 $field
     * @param array|string|Arrayable|stdClass $value
     * @return int
     */
    public function hset($key, $field, $value)
    {
        return $this->redis->hset($this->taggedItemKey($key), $field, $this->toString($value));
    }

    /**
     * @param $key
     * @return int
     */
    public function hlen($key)
    {
        return (int) $this->redis->hlen($this->taggedItemKey($key));
    }

    /**
     * @param $key
     * @param $field
     * @param $value
     * @return int
     */
    public function hincrby($key, $field, $value)
    {
        return (int) $this->redis->hincrby($this->taggedItemKey($key), $field, $value);
    }

    /**
     * @param $key
     * @param $fields
     * @return array
     */
    public function hmget($key, $fields)
    {
        $fields = $this->toArray($fields);
        $result = $this->redis->hmget($this->taggedItemKey($key), $this->toArray($fields));

        return array_combine($fields, $this->unserializeResult($result));
    }

    /**
     * @param                 $key
     * @param array|Arrayable $dictionary
     * @return mixed
     */
    public function hmset($key, $dictionary)
    {
        if ($dictionary instanceof Arrayable) {
            $dictionary = $dictionary->toArray();
        }

        foreach ($dictionary as &$value) {
            if (is_array($value) || is_object($value)) {
                $value = serialize($value);
            }
        }

        unset($value);

        $dictionary = (array) $dictionary;
        if (!$dictionary) {
            return true;
        }

        return $this->redis->hmset($this->taggedItemKey($key), $dictionary);
    }

    /**
     * @param       $key
     * @param       $cursor
     * @param array $options
     * @return array
     */
    public function hscan($key, $cursor = 0, $options = [])
    {
        return (array) $this->redis->hscan($this->taggedItemKey($key), $cursor, $options);
    }

    /**
     * 返回哈希表 key 中的所有域
     * @param $key
     * @return array
     */
    public function hkeys($key): array
    {
        return (array) $this->redis->hkeys($this->taggedItemKey($key));
    }

    /**
     * @param $key
     * @return int
     */
    public function llen($key)
    {
        return (int) $this->redis->llen($this->taggedItemKey($key));
    }


    /**
     * 返回列表 key 中指定区间内的元素，区间以偏移量 start 和 stop 指定
     * @param $key
     * @param $start
     * @param $stop
     * @return array
     */
    public function lrange($key, $start, $stop)
    {
        return $this->redis->lrange($this->taggedItemKey($key), $start, $stop);
    }

    /**
     * @param $key
     * @return string
     */
    public function lpop($key)
    {
        return (string) $this->redis->lpop($this->taggedItemKey($key));
    }

    /**
     * @param              $key
     * @param string|array $elements
     * @return int
     */
    public function pfadd($key, $elements)
    {
        $elements = (array) $elements;
        return $this->redis->pfadd($this->taggedItemKey($key), $elements);
    }

    /**
     * @param     $key
     * @param int $timeout
     * @return array|null
     */
    public function blpop($key, $timeout = 2)
    {
        return $this->redis->blpop($this->taggedItemKey($key), $timeout);
    }

    public function pfcount($key)
    {
        $keys = (array) $key;

        return $this->redis->pfcount(array_map(function ($key) {
            return $this->taggedItemKey($key);
        }, $keys));
    }

    /**
     * @param $key
     * @param $values
     * @return int
     */
    public function lpush($key, $values)
    {
        return $this->redis->lpush($this->taggedItemKey($key), $this->toArray($values));
    }

    /**
     * @param $key
     * @return string
     */
    public function rpop($key)
    {
        return (string) $this->redis->rpop($this->taggedItemKey($key));
    }

    /**
     * @param $key
     * @param $values
     * @return int
     */
    public function rpush($key, $values)
    {
        return $this->redis->rpush($this->taggedItemKey($key), $this->toArray($values));
    }

    /**
     * 新增集合元素
     * @param string       $key     key
     * @param string|array $members 成员
     * @return bool
     */
    public function sadd($key, $members): bool
    {
        return (bool) $this->redis->sadd($this->taggedItemKey($key), $this->toArray($members));
    }


    /**
     * 对比多个 key
     * @params array $keys
     * @return array
     */
    public function sdiff($keys)
    {
        return $this->redis->sdiff($this->taggedItemKey($keys));
    }

    /**
     * 这个命令的作用和 SDIFF key [key …] 类似，但它将结果保存到 destination 集合，而不是简单地返回结果集。
     * @param $destination
     * @param $keys
     * @return int
     */
    public function sdiffstore($destination, $keys)
    {
        return $this->redis->sdiffstore($this->taggedItemKey($destination), $this->taggedItemKey($keys));
    }

    /**
     * 返回集合的数量
     * @param string $key key
     * @return int
     */
    public function scard($key): int
    {
        return (int) $this->redis->scard($this->taggedItemKey($key));
    }

    /**
     * 随机返回 count个元素
     * @param string $key   key
     * @param int    $count 数量
     * @return array
     */
    public function srandmember($key, int $count): array
    {
        return (array) $this->redis->srandmember($this->taggedItemKey($key), $count);
    }

    /**
     * 移除一个或多个元素
     * @param string       $key    key
     * @param string|array $member 成员
     * @return int
     */
    public function srem($key, $member)
    {
        return $this->redis->srem($this->taggedItemKey($key), $this->toArray($member));
    }

    /**
     * @param $key
     * @param $member
     * @return bool
     */
    public function sismember($key, $member): bool
    {
        return (bool) $this->redis->sismember($this->taggedItemKey($key), $member);
    }

    /**
     * @param       $key
     * @param int   $cursor
     * @param array $options
     * @return array
     */
    public function sscan($key, $cursor = 0, $options = [])
    {
        return (array) $this->redis->sscan($this->taggedItemKey($key), $cursor, $options);
    }

    /**
     * 获取集合的所有成员
     * @param $key
     * @return array
     */
    public function smembers($key)
    {
        return (array) $this->redis->smembers($this->taggedItemKey($key));
    }

    /**
     * 有序集合
     * @param       $key
     * @param array $membersAndScoresDictionary 参数 ['value' => 'score']
     * @return int
     */
    public function zadd($key, array $membersAndScoresDictionary)
    {
        return $this->redis->zadd($this->taggedItemKey($key), $membersAndScoresDictionary);
    }

    /**
     * @param $key
     * @param $increment
     * @param $member
     * @return string
     */
    public function zincrBy($key, $increment, $member)
    {
        return $this->redis->zincrby($this->taggedItemKey($key), $increment, $member);
    }

    /**
     * @param $key
     * @return int
     */
    public function zcard($key)
    {
        return (int) $this->redis->zcard($this->taggedItemKey($key));
    }

    /**
     * @param $key
     * @param $member
     * @return int
     */
    public function zrem($key, $member)
    {
        return $this->redis->zrem($this->taggedItemKey($key), $member);
    }

    /**
     * 返回成员的排名, 按照score从小到大的排名, 最小为0
     * @param $key
     * @param $member
     * @return int|mixed
     */
    public function zrank($key, $member)
    {
        return $this->redis->zrank($this->taggedItemKey($key), $member);
    }

    /**
     * @param       $key
     * @param       $start
     * @param       $stop
     * @param array $options
     * @return array
     */
    public function zrange($key, $start, $stop, $options = [])
    {
        return (array) $this->redis->zrange($this->taggedItemKey($key), $start, $stop, $options);
    }


    /**
     * 返回有序集 key 中，所有 score 值介于 min 和 max 之间(包括等于 min 或 max )的成员。有序集成员按 score 值递增(从小到大)次序排列
     * @param string $key
     * @param int    $start
     * @param int    $stop
     * @param array  $options
     * @return array
     */
    public function zrangebyscore($key, $start, $stop, $options = [])
    {
        return (array) $this->redis->zrangebyscore($this->taggedItemKey($key), $start, $stop, $options);
    }

    /**
     * 移除有序集 key 中，所有 score 值介于 min 和 max 之间(包括等于 min 或 max )的成员。
     * @param $key
     * @param $start
     * @param $stop
     * @return array
     */
    public function zremrangebyscore($key, $start, $stop)
    {
        return (array) $this->redis->zremrangebyscore($this->taggedItemKey($key), $start, $stop);
    }

    /**
     * @param string $key
     * @param int    $start
     * @param int    $stop
     * @param array  $options
     * @return array
     */
    public function zrevrange($key, $start, $stop, $options = [])
    {
        return (array) $this->redis->zrevrange($this->taggedItemKey($key), $start, $stop, $options);
    }

    /**
     * @param       $key
     * @param       $cursor
     * @param array $options
     * @return array
     */
    public function zscan($key, $cursor = 0, $options = [])
    {
        return (array) $this->redis->zscan($this->taggedItemKey($key), $cursor, $options);
    }

    /**
     * @param $key
     * @param $member
     * @return string|null
     */
    public function zscore($key, $member): ?string
    {
        return $this->redis->zscore($this->taggedItemKey($key), $member);
    }

    /**
     * @param $key
     * @param $member
     * @return int|null
     */
    public function zrevrank($key, $member)
    {
        return $this->redis->zrevrank($this->taggedItemKey($key), $member);
    }

    /**
     * 设置有效期
     * @param string $key     key
     * @param int    $seconds 秒数
     * @return bool
     */
    public function expire($key, int $seconds): bool
    {
        return (bool) $this->redis->expire($this->taggedItemKey($key), $seconds);
    }

    /**
     * 设置有效期
     * @param string $key       key
     * @param int    $timestamp 失效时间
     * @return bool
     */
    public function expireat($key, $timestamp): bool
    {
        return (bool) $this->redis->expireat($this->taggedItemKey($key), $timestamp);
    }

    /**
     * @return mixed
     */
    public function multi()
    {
        return $this->redis->multi();
    }

    /**
     * @return array
     */
    public function exec()
    {
        return $this->redis->exec();
    }

    /**
     * 获取key下面的所有key
     * @param string $key 给定的key
     * @return array
     */
    public function keys($key): array
    {
        return (array) $this->redis->keys($this->taggedItemKey($key));
    }

    /**
     * 删除key
     * @param string|array $keys 缓存key
     * @return int
     */
    public function del($keys): int
    {
        $keys = $this->toArray($keys);

        return $this->redis->del(array_map(function ($key) {
            return $this->taggedItemKey($key);
        }, $keys));
    }

    /**
     * 添加用户地址位置
     * @param string $key       key
     * @param string $longitude 经度
     * @param string $latitude  纬度
     * @param int    $member    成员
     * @return bool
     */
    public function geoadd($key, $longitude, $latitude, $member): bool
    {
        return (bool) $this->redis->geoadd($this->taggedItemKey($key), $longitude, $latitude, $member);
    }

    /**
     * 获取用户地理位置
     * @param string       $key     key
     * @param array|string $members 用户列表
     * @return array
     */
    public function geopos($key, $members): array
    {
        return (array) $this->redis->geopos($this->taggedItemKey($key), $this->toArray($members));
    }

    /**
     * 计算两个位置距离
     * @param string    $key     key
     * @param int|mixed $member1 成员1
     * @param int|mixed $member2 成员2
     * @param string    $unit    单位[m:米; km:千米; mi:英里; ft:英尺]
     * @return string|null|float
     */
    public function geodist($key, $member1, $member2, $unit = 'm')
    {
        return $this->redis->geodist($this->taggedItemKey($key), $member1, $member2, $unit);
    }

    /**
     * 以给定的经纬度为中心， 返回键包含的位置元素当中， 与中心的距离不超过给定最大距离的所有位置元素。
     * @param string       $key       key
     * @param string       $longitude 经度
     * @param string       $latitude  纬度
     * @param string|float $radius    距离/半径
     * @param string       $unit      单位 [m;km;mi;ft]
     * @param array|null   $options   附加选项[WITHDIST: 返回距离; WITHCOORD: 返回经纬度; WITHHASH:返回hash值; count: 返回数量]
     * @return array
     */
    public function georadius($key, $longitude, $latitude, $radius, $unit, array $options = []): array
    {
        return (array) $this->redis->georadius($this->taggedItemKey($key), $longitude, $latitude, $radius, $unit, $options);
    }

    /**
     * 以给定的元素为中心，与中心的距离不超过给定最大距离的所有位置元素。
     * @param string       $key     key
     * @param int          $member  成员
     * @param string|float $radius  距离/半径
     * @param string       $unit    单位 [m;km;mi;ft]
     * @param array|null   $options 附加选项[WITHDIST: 返回距离; WITHCOORD: 返回经纬度; WITHHASH:返回hash值; count: 返回数量]
     * @return array
     */
    public function georadiusbymember($key, $member, $radius, $unit, array $options = [])
    {
        return (array) $this->redis->georadiusbymember($this->taggedItemKey($key), $member, $radius, $unit, $options);
    }

    /**
     * 选择数据库
     * @param string $database 数据库
     * @return bool
     * @throws ApplicationException
     */
    public function select(string $database): bool
    {
        $database = config("database.redis.$database.database");

        if ($database === null) {
            throw new ApplicationException("database [$database] not found");
        }

        try {
            $this->redis->select((int) $database);
        } catch (Throwable $e) {
            throw new ApplicationException('系统内部错误');
        }

        return true;
    }

    /**
     * 断开连接
     * @return bool
     */
    public function disconnect(): bool
    {
        try {
            $this->redis->disconnect();
        } catch (Throwable $e) {

        }

        return true;
    }

    /**
     * 删除标签key
     * @param string|array $keys key
     * @return int
     */
    public function delTaggedKeys($keys): int
    {
        $keys = $this->toArray($keys);

        return $this->redis->del($keys);
    }

    /**
     * 扫描所有key
     * @param       $cursor
     * @param array $options
     * @return array
     */
    public function scan($cursor, array $options = [])
    {
        return (array) $this->redis->scan($cursor, $options);
    }


    /**
     * @param Closure $closure
     * @return array|Pipeline
     */
    public function pipeline(Closure $closure)
    {
        return $this->redis->pipeline($closure);
    }

    /**
     * 设置位图
     * @param string $key    key
     * @param int    $offset 偏移量
     * @param int    $value  值
     * @return int
     */
    public function setbit(string $key, int $offset, int $value): int
    {
        return (int) $this->redis->setbit($this->taggedItemKey($key), $offset, $value);
    }

    /**
     * 获取位图上偏移量的位
     * @param string $key
     * @param int    $offset
     * @return int
     */
    public function getbit(string $key, int $offset): int
    {
        return (int) $this->redis->getbit($this->taggedItemKey($key), $offset);
    }

    /**
     * 当 key 不存在时，返回 -2 .当 key 存在但没有设置剩余生存时间时，返回 -1 。 否则，以秒为单位，返回 key 的剩余生存时间
     * @param string $key
     * @return int
     */
    public function ttl(string $key): int
    {
        return (int) $this->redis->ttl($this->taggedItemKey($key));
    }

    /**
     * 将字段数组化
     * @param string|array $fields 字段
     * @return array
     */
    private function toArray($fields): array
    {
        if (!is_array($fields)) {
            $fields = [$fields];
        }

        return $fields;
    }

    /**
     * 将数据转为字符串
     * @param array|string|Arrayable|stdClass $value
     * @return string
     */
    private function toString($value): string
    {
        if ($value instanceof Arrayable) {
            $value = $value->toArray();
        }
        elseif (is_object($value)) {
            $value = (array) $value;
        }

        if (is_array($value)) {
            $value = json_encode($value);
        }

        return (string) $value;
    }

    /**
     * @param $cache_key
     * @return mixed 可以返回数组或者字串
     */
    private function taggedItemKey($cache_key)
    {

        if (is_array($cache_key)) {
            $keys = [];
            foreach ($cache_key as $_key) {
                $keys[] = $this->taggedItemKey($_key);
            }
            return $keys;
        }

        $prefix = config('cache.prefix');
        $key    = $prefix;

        if ($this->cacheTag) {
            $key .= ":{$this->cacheTag}";
        }

        $key .= ":{$cache_key}";

        return $key;
    }

    /**
     * 反序列化结果
     * @param array $result 结果
     * @return array
     */
    private function unserializeResult($result): array
    {
        return array_map([$this, 'unserializeValue'], (array) $result);
    }

    /**
     * 反序列化数据
     * @param string|mixed $value 数值
     * @return mixed
     */
    private function unserializeValue($value)
    {
        if (!$value) {
            return $value;
        }

        try {
            return unserialize($value);
        } catch (Throwable $e) {
            return $value;
        }
    }
}