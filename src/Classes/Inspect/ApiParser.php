<?php

namespace Poppy\Core\Classes\Inspect;

use Curl\Curl;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Poppy\Framework\Classes\Traits\AppTrait;
use Poppy\Framework\Exceptions\ApplicationException;
use Storage;

class ApiParser
{
    use AppTrait;

    /**
     * @var string 请求类型
     */
    private $type;

    /**
     * @var array 包含URL定义的信息
     */
    private $definition;

    /**
     * @var string 标题
     */
    private $title;

    /**
     * @var string 描述
     */
    private $description;

    /**
     * @var string 状态描述
     */
    private $statusDesc;

    /**
     * @var string 相应信息
     */
    private $resp;

    /**
     * @var int 请求的状态码
     */
    private $statusCode;

    /**
     * @var string 请求地址
     */
    private $url;

    /**
     * @var array 当前请求日志
     */
    private $currentLog = [];

    /**
     * @var array 所有日志
     */
    private $logs = [];

    /**
     * @var string 请求的URL地址
     */
    private $baseUrl;

    /**
     * @var array 参数
     */
    private $params = [];

    /**
     * @var string 请求方法
     */
    private $method;

    /**
     * ApiParser constructor.
     * @param string $type 请求类型
     * @param string $url  请求地址
     * @throws ApplicationException
     * @throws FileNotFoundException
     */
    public function __construct(string $type, $url = '')
    {
        $this->type    = $type;
        $this->baseUrl = $url ?: config('app.url');

        if (!$this->type) {
            throw new ApplicationException('Empty Type Input');
        }
        $types = array_keys(config('poppy.core.apidoc'));
        if (!in_array($this->type, $types, true)) {
            throw new ApplicationException('Error Type In Apidoc');
        }

        $jsonPath = '/docs/' . $type . '/api_data.json';
        if ($url) {
            $apiJson = $url . $jsonPath;
            $Curl    = new Curl();
            if ($definition = $Curl->get($apiJson)) {
                if (!$definition) {
                    throw new ApplicationException($Curl->errorMessage);
                }
                $this->definition = is_array($definition) ? $definition : json_decode($definition);
            }
        }
        else {
            $Disk = Storage::disk('public');
            if (!$Disk->exists($jsonPath)) {
                throw new ApplicationException('File Not Exists At `' . $jsonPath . '`!');
            }
            if ($definition = $Disk->get($jsonPath)) {
                $this->definition = json_decode($definition);
            }
        }
    }

    /**
     * @return array
     */
    public function getCurrentLog(): array
    {
        return $this->currentLog;
    }

    /**
     * @return array
     */
    public function getLogs(): array
    {
        return $this->logs;
    }

    /**
     * @return array
     */
    public function getDefinition(): array
    {
        return $this->definition;
    }
}