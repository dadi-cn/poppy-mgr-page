<?php namespace Poppy\Version\Action;

use Exception;
use Poppy\Core\Redis\RdsDb;
use Poppy\Framework\Classes\Traits\AppTrait;
use Poppy\Framework\Validation\Rule;
use Poppy\Version\Classes\PyVersionDef;
use Poppy\Version\Models\SysAppVersion;
use Validator;

/**
 * App 版本
 */
class Version
{
    use AppTrait;

    /**
     * @var SysAppVersion
     */
    protected $item;

    /**
     * @var string Table Name
     */
    protected $table;

    /**
     * @var int $id
     */
    protected $id;

    public function __construct()
    {
        $this->table = (new SysAppVersion())->getTable();
    }

    public function establish($data, $id = null): bool
    {
        $initDb = [
            'title'        => (string) sys_get($data, 'title'),
            'download_url' => (string) sys_get($data, 'download_url'),
            'description'  => (string) sys_get($data, 'description'),
            'is_upgrade'   => (int) sys_get($data, 'is_upgrade', 0),
            'platform'     => sys_get($data, 'platform', SysAppVersion::PLATFORM_ANDROID),
        ];
        if (!version_compare($initDb['title'], '0.0.1', '>=')) {
            return $this->setError('版本号命名不规范');
        }
        $validator = Validator::make($initDb, [
            'title'        => [
                Rule::required(),
                Rule::string(),
                Rule::unique($this->table, 'title')->where(function ($query) use ($id, $initDb) {
                    if ($id) {
                        $query->where('id', '!=', $id);
                    }
                    $query->where('platform', $initDb['platform']);
                }),
            ],
            'download_url' => [
                Rule::string(),
                Rule::url(),
            ],
            'description'  => [
                Rule::required(),
                Rule::string(),
            ],
        ], [], [
            'title'        => '版本号',
            'download_url' => '下载地址',
            'description'  => '版本更新描述',
        ]);
        if ($validator->fails()) {
            return $this->setError($validator->errors());
        }

        if (!preg_match("/\d\.\d+\..+/", $initDb['title'])) {
            return $this->setError('版本号格式不正确');
        }

        if ($initDb['platform'] === SysAppVersion::PLATFORM_ANDROID && !$initDb['download_url']) {
            return $this->setError('请输入下载地址');
        }

        // init
        if ($id && !$this->init($id)) {
            return false;
        }

        if ($id) {
            $this->item->update($initDb);
        }
        else {
            /** @var SysAppVersion $appVersion */
            $appVersion = SysAppVersion::create($initDb);
            $this->item = $appVersion;
        }
        $this->clearCache($this->item->platform);
        return true;
    }

    /**
     * 删除数据
     * @param int $id 版本ID
     * @return bool|null
     */
    public function delete($id)
    {
        if ($id && !$this->init($id)) {
            return false;
        }

        try {
            $this->clearCache($this->item->platform);
            return $this->item->delete();
        } catch (Exception $e) {
            return $this->setError($e->getMessage());
        }
    }

    /**
     * 初始化
     * @param int $id 版本ID
     * @return bool
     */
    public function init($id): bool
    {
        try {
            $this->item = SysAppVersion::findOrFail($id);
            $this->id   = $this->item->id;
            return true;
        } catch (Exception $e) {
            return $this->setError('ID 不合法, 不存在此数据');
        }
    }

    private function clearCache($platform)
    {
        RdsDb::instance()->hDel(PyVersionDef::ckTagMaxVersion(), $platform);
    }
}