<?php

namespace Poppy\Sms\Action;

use Poppy\Framework\Classes\Traits\AppTrait;
use Poppy\Framework\Validation\Rule;
use Poppy\System\Classes\Traits\PamTrait;
use Poppy\System\Classes\Traits\SystemTrait;
use Validator;
use View;

/**
 * 短信模板action
 */
class Sms
{
    use AppTrait, PamTrait, SystemTrait;

    public const SCOPE_LOCAL  = 'local';
    public const SCOPE_ALIYUN = 'aliyun';

    private const CACHE_TEMPLATES = 'poppy::sms.template';


    /**
     * @var mixed 所有的模版
     */
    private $templates;

    /**
     * @var array 项目条目
     */
    private $item;

    public function __construct()
    {
        $this->templates = sys_setting(self::CACHE_TEMPLATES, []) ?: [];
    }


    /**
     * 获取所有的模版
     * @return array
     */
    public function getTemplates(): array
    {
        return $this->templates;
    }

    /**
     * @return array
     */
    public function getItem(): array
    {
        return $this->item;
    }

    /**
     * 新增和编辑
     * @param array    $data data <br />
     *                       type     类型 <br />
     *                       code     代码 <br />
     *                       content  内容
     * @param null|int $id
     * @return bool
     */
    public function establish(array $data, $id = null): bool
    {
        if (!$this->checkPam()) {
            return false;
        }

        $input = sys_get($data, ['type', 'code', 'content', 'scope']);

        $validator = Validator::make($input, [
            'type'    => [
                Rule::required(),
                Rule::in(array_keys(self::kvType())),
            ],
            'code'    => [
                Rule::required(),
            ],
            'scope'   => [
                Rule::required(),
            ],
            'content' => [
                Rule::required(),
            ],
        ], [], [
            'type'    => '类型',
            'code'    => '模版代码',
            'scope'   => '平台类型',
            'content' => '短信内容',
        ]);

        if ($validator->fails()) {
            return $this->setError($validator->messages());
        }

        $scope = $input['scope'];
        $type  = $input['type'];


        $templates  = $this->templates;
        $Collection = collect($templates);

        if ((clone $Collection)->where('id', '!=', $id)->where('scope', $scope)->where('type', $type)->first()) {
            return $this->setError('模板类型已经存在');
        }

        // 修改数据
        if ($id) {
            $index_key   = $this->indexKey($id);
            $input['id'] = $id;

            $templates[$index_key] = $input;
        }
        else {
            $templates[] = $input;
        }

        return $this->save($templates);
    }

    /**
     * 初始化
     * @param int $id ID
     * @return bool
     */
    public function init(int $id): bool
    {
        $item = collect($this->templates)->where('id', $id)->first();
        if ($item) {
            $this->item = $item;
            return true;
        }
        return $this->setError('短信ID不存在');
    }


    /**
     * 分享
     */
    public function share(): void
    {
        View::share([
            'item'  => $this->item,
            'scope' => $this->item['scope'] ?? self::SCOPE_LOCAL,
        ]);
    }

    /**
     * 刪除
     * @param int $id id
     * @return bool
     */
    public function destroy(int $id): bool
    {
        $index_key = $this->indexKey($id);
        if (isset($this->templates[$index_key])) {
            unset($this->templates[$index_key]);
        }

        return $this->save($this->templates);
    }

    /**
     * 短信类型
     * @param string|null $key       key
     * @param bool        $check_key 检测key是否存在
     * @return array|string
     */
    public static function kvType($key = null, $check_key = false)
    {
        $desc = collect(config('poppy.sms.types') ?: [])->pluck('title', 'type')->toArray();
        return kv($desc, $key, $check_key);
    }

    /**
     * 平台类型
     * @param null|string $key
     * @param false       $check_key
     * @return array|bool|string
     */
    public static function kvPlatform($key = null, $check_key = false)
    {
        $desc = [
            self::SCOPE_LOCAL  => 'Local(本地)',
            self::SCOPE_ALIYUN => 'Aliyun(阿里云)',
        ];
        return kv($desc, $key, $check_key);
    }

    /**
     * 获取指定平台对应类型的模板
     * @param string $type 类型
     * @return array|null [type|code|content|id]
     */
    public static function smsTpl(string $type): ?array
    {
        $scope    = config('poppy.sms.send_type', self::SCOPE_LOCAL);
        $template = collect((new Sms())->getTemplates())->where('scope', $scope)->where('type', $type)->first();
        return $template ?? null;
    }


    /**
     * 保存模板
     * @param array $templates 模板信息
     * @return bool
     */
    private function save(array $templates): bool
    {
        $templates = collect($templates)->map(function ($item, $index) {
            $item['id'] = ++$index;
            return $item;
        })->values()->toArray();

        $this->sysSetting()->set(self::CACHE_TEMPLATES, $templates);
        sys_cache('py-sms')->clear();

        return true;
    }

    /**
     * 索引
     * @param int $id id
     * @return mixed
     */
    private function indexKey(int $id): int
    {
        return --$id;
    }

}