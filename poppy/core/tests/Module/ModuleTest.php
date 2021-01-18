<?php namespace Poppy\Core\Tests\Module;

use Poppy\Core\Classes\Traits\CoreTrait;
use Poppy\Core\Module\Module;
use Poppy\Framework\Application\TestCase;

class ModuleTest extends TestCase
{


    use CoreTrait;


    public function setUp(): void
    {
        parent::setUp();
        py_console()->call('cache:clear');
    }

    public function testHasAttributes()
    {
        $module = (new Module('module.site'));

        $this->assertEquals(base_path('modules/site'), $module->directory());

        $this->assertEquals('module.site', $module->slug());

        $this->assertEquals('Site', $module->namespace());
    }

    public function testMenus()
    {
        $menus = $this->coreModule()->menus();
        dd($menus);
        dump($menus['system/backend']);
    }

    public function testRepos()
    {
        $repo = $this->coreModule()->repository();
        dd($repo);
    }

    public function testServices()
    {
        $repo = $this->coreModule()->services();
        dd($repo);
    }
}