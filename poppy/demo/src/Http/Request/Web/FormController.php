<?php namespace Poppy\Demo\Http\Request\Web;

use Poppy\Framework\Exceptions\ApplicationException;
use Poppy\System\Classes\Layout\Content;
use Poppy\System\Http\Request\Web\WebController;

/**
 * 内容生成器
 */
class FormController extends WebController
{
    /**
     * 主页
     * @param      $type
     * @return Content
     * @throws ApplicationException
     */
    public function index($type)
    {
        $Form = $this->factory($type);
        return (new Content())->title('Form ' . $type)->body($Form);
    }


    private function factory($type)
    {
        static $factories;
        if (!isset($factories[$type])) {
            $className = '\Poppy\Demo\Forms\Form' . $type;
            if (!class_exists($className)) {
                throw new ApplicationException("类 {$className} 不存在!");
            }
            $factories[$type] = new $className;
        }
        return $factories[$type];
    }
}