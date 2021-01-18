<?php namespace Poppy\Core\Commands;

use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Poppy\Core\Classes\Traits\CoreTrait;
use Poppy\Core\Events\PermissionInitEvent;
use Poppy\Core\Module\Repositories\Modules;
use Poppy\Core\Rbac\Permission\Permission;
use Poppy\Core\Rbac\Permission\PermissionManager;
use Poppy\Framework\Exceptions\ApplicationException;

/**
 * Class PermissionCommand.
 */
class PermissionCommand extends Command
{
    use CoreTrait;

    protected $signature = 'py-core:permission
		{do : The permission action to handle, allow <lists,init>}
		{--permission= : The permission need to check}
		';

    protected $description = 'Permission manage list.';

    /**
     * @var string Display Key;
     */
    private $key;


    /**
     * @var PermissionManager
     */
    private $permission;

    /**
     * @var string
     */
    private $roleModel;

    /**
     * @var string
     */
    private $permissionModel;


    public function __construct()
    {
        parent::__construct();
        $this->permission      = $this->corePermission();
        $this->roleModel       = config('poppy.core.rbac.role');
        $this->permissionModel = config('poppy.core.rbac.permission');
        if (!$this->roleModel || !$this->permissionModel) {
            throw new ApplicationException('你需要配置 `poppy.core` 的 RBAC 配置');
        }
    }

    /**
     * Command Handler.
     * @return bool
     * @throws Exception
     */
    public function handle()
    {
        $action    = $this->argument('do');
        $this->key = $action;
        switch ($action) {
            case 'list':
                $this->lists();
                break;
            case 'init':
                $this->init();
                break;
            case 'menus':
                $this->checkMenus();
                break;
            case 'assign':
                $this->assign();
                break;
            case 'check':
                $permission = $this->option('permission');
                $this->checkPermission($permission);
                break;
            default:
                $this->error(
                    sys_mark('poppy.core', self::class, ' Command Not Exists!')
                );
                break;
        }

        return true;
    }

    public function lists()
    {
        $data = new Collection();
        $this->permission->permissions()->each(function (Permission $permission) use ($data) {
            $data->push([
                $permission->type(),
                $permission->key(),
                $permission->description(),
            ]);
        });
        $this->table(
            ['Type', 'Identification', 'Description'],
            $data->toArray()
        );
    }

    /**
     * @throws Exception
     */
    public function init()
    {
        sys_cache('py-core')->forget(Modules::CACHE_NAME);
        sys_cache('py-core')->forget(PermissionManager::CACHE_NAME);

        // get all permission
        $permissions = $this->permission->permissions();
        if (!$permissions) {
            $this->info($this->key . 'No permission need import.');

            return;
        }

        event(new PermissionInitEvent($permissions));

        $this->info(
            sys_mark('poppy.core', self::class, 'Import permission Success! ')
        );
        sys_cache('py-core')->forget(PermissionManager::CACHE_NAME);
    }

    /**
     * 将权限赋值给指定的用户组
     */
    private function assign()
    {
        $name            = $this->ask('Which role you want assign permission ?');
        $permission_type = $this->ask('Which permission you want to get ?');
        $role            = (new $this->roleModel)::where('name', $name)->first();

        if (!$role) {
            $this->error(
                sys_mark('poppy.core', self::class, 'Role [' . $name . '] not exists in table !')
            );

            return;
        }

        $permissions = (new $this->permissionModel)::where('type', $permission_type)->get();
        if (!$permissions) {
            $this->error(
                sys_mark('poppy.core', self::class, 'Permission type [' . $permission_type . '] has no permissions !')
            );

            return;
        }
        $role->savePermissions($permissions);
        $role->flushPermissionRole();
        $this->info("\nSave [{$permission_type}] permission to role [{$name}] !");
    }

    /**
     * @param string $permission 需要检测的权限
     */
    private function checkPermission(string $permission)
    {
        if ((new $this->permissionModel)::where('name', $permission)->exists()) {
            $this->info(
                sys_mark('poppy.core', self::class, 'Permission `' . $permission . '` in table ')
            );
        }
        else {
            $this->error(
                sys_mark('poppy.core', self::class, 'Permission `' . $permission . '` not in table')
            );
        }
    }

    /**
     * 检查菜单
     */
    private function checkMenus()
    {
        // clear cache
        sys_cache('py-core')->flush();

        // calc
        $navigations = $this->coreModule()->menus();
        $format      = function ($item) {
            return [
                'title'      => $item['text'],
                'parent'     => $item['parent'],
                'permission' => $item['permission'],
            ];
        };

        $faults = collect();
        $navigations->each(function ($item) use ($faults, $format) {
            // 订单 / 系统
            $permission = $item['permission'] ?? '';
            if ($permission && !$this->corePermission()->has($permission)) {
                $faults->push($format($item));
            }
            // 分组
            $children = collect((array) $item['children']);
            $children->map(function ($item) use ($faults, $format) {
                $permission = $item['permission'] ?? '';
                if ($permission && !$this->corePermission()->has($permission)) {
                    $faults->push($format($item));
                }
                $children = collect((array) $item['children']);
                // 路由
                $children->each(function ($item) use ($faults, $format) {
                    $permission = $item['permission'] ?? '';
                    if ($permission && !$this->corePermission()->has($permission)) {
                        $faults->push($format($item));
                    }
                });
            });
        });

        if (!$faults->count()) {
            $this->info(
                sys_mark('poppy.core', self::class, 'All Permission are right.')
            );
        }
        else {
            $this->warn(
                sys_mark('poppy.core', self::class, 'Error Permission in menus:')
            );
            $this->table(
                ['Title', 'Parent', 'Permission'],
                $faults->toArray()
            );
        }
    }
}
