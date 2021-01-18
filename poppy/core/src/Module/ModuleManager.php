<?php namespace Poppy\Core\Module;

use Illuminate\Support\Collection;
use Poppy\Core\Module\Repositories\Modules;
use Poppy\Core\Module\Repositories\ModulesHook;
use Poppy\Core\Module\Repositories\ModulesMenu;
use Poppy\Core\Module\Repositories\ModulesPage;
use Poppy\Core\Module\Repositories\ModulesService;
use Poppy\Core\Module\Repositories\ModulesSetting;

/**
 * Class ModuleManager.
 */
class ModuleManager
{

    /**
     * @var Collection
     */
    protected $excepts;

    /**
     * @var ModulesMenu
     */
    protected $menuRepository;

    /**
     * @var ModulesPage
     */
    protected $pageRepository;

    /**
     * @var ModulesSetting
     */
    protected $settingRepository;

    /**
     * @var ModulesHook
     */
    protected $hooksRepo;

    /**
     * @var ModulesService
     */
    protected $serviceRepo;

    /**
     * @var Modules
     */
    protected $repository;

    /**
     * ModuleManager constructor.
     */
    public function __construct()
    {
        $this->excepts = collect();
    }

    /**
     * @return Collection
     */
    public function enabled()
    {
        return $this->repository()->enabled();
    }

    /**
     * @return Modules
     */
    public function repository(): Modules
    {
        if (!$this->repository instanceof Modules) {
            $this->repository = new Modules();
            $slugs            = app('poppy')->enabled()->pluck('slug');
            $this->repository->initialize($slugs);
        }
        return $this->repository;
    }

    /**
     * Get a module by name.
     * @param mixed $name name
     * @return Module
     */
    public function get($name): Module
    {
        return $this->repository()->get($name);
    }

    /**
     * Check for module exist.
     * @param mixed $name name
     * @return bool
     */
    public function has($name): bool
    {
        return $this->repository()->has($name);
    }

    /**
     * @return array
     */
    public function getExcepts(): array
    {
        return $this->excepts->toArray();
    }

    /**
     * @return ModulesMenu
     */
    public function menus(): ModulesMenu
    {
        if (!$this->menuRepository instanceof ModulesMenu) {
            $collection = collect();
            $this->repository()->enabled()->each(function (Module $module) use ($collection) {
                $collection->put($module->slug(), $module->get('menus', []));
            });
            $this->menuRepository = new ModulesMenu();
            $this->menuRepository->initialize($collection);
        }

        return $this->menuRepository;
    }

    /**
     * @return ModulesSetting
     */
    public function settings(): ModulesSetting
    {
        if (!$this->settingRepository instanceof ModulesSetting) {
            $collection = collect();
            $this->repository()->enabled()->each(function (Module $module) use ($collection) {
                $collection->put($module->slug(), $module->get('settings', []));
            });
            $this->settingRepository = new ModulesSetting();
            $this->settingRepository->initialize($collection);
        }

        return $this->settingRepository;
    }

    /**
     * @return ModulesHook
     */
    public function hooks(): ModulesHook
    {
        if (!$this->hooksRepo instanceof ModulesHook) {
            $collect = collect();
            $this->repository()->enabled()->each(function (Module $module) use ($collect) {
                $collect->put($module->slug(), $module->get('hooks', []));
            });
            $this->hooksRepo = new ModulesHook();
            $this->hooksRepo->initialize($collect);
        }

        return $this->hooksRepo;
    }

    /**
     * @return ModulesService(
     */
    public function services(): ModulesService
    {
        if (!$this->serviceRepo instanceof ModulesService) {
            $collect = collect();
            $this->repository()->enabled()->each(function (Module $module) use ($collect) {
                $collect->put($module->slug(), $module->get('services', []));
            });
            $this->serviceRepo = new ModulesService();
            $this->serviceRepo->initialize($collect);
        }

        return $this->serviceRepo;
    }

    /**
     * @param array $excepts 数据数组
     */
    public function registerExcept(array $excepts): void
    {
        foreach ((array) $excepts as $except) {
            $this->excepts->push($except);
        }
    }
}
