<?php namespace Poppy\Demo\Http\Forms\Helpers;

use Poppy\Framework\Helper\EnvHelper;
use Poppy\System\Classes\Widgets\FormWidget;
use ReflectionClass;

class FormEnvHelper extends FormWidget
{


    /**
     * 表单标题
     * @var string
     */
    public $title = 'EnvHelper';


    /**
     * Build a form here.
     */
    public function form()
    {
        $Ref     = new ReflectionClass(EnvHelper::class);
        $methods = $Ref->getMethods();
        foreach ($methods as $method) {
            if ($method->isPublic()) {
                $methodName = $method->getName();
                $result     = EnvHelper::$methodName();
                if (is_bool($result)) {
                    if ($result) {
                        $result = 'true';
                    }
                    else {
                        $result = 'false';
                    }
                }
                $this->display($methodName, ucfirst($methodName))->default($result)->help(ucfirst($methodName));
            }
        }
    }
}
