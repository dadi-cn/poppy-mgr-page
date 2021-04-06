<?php

namespace Demo\Http\Request\Web;

use Demo\Forms\FormEntrance;
use Demo\Http\Forms\Helpers\FormEnvHelper;
use Demo\Http\Forms\Helpers\FormImageHelper;
use Demo\Http\Forms\Helpers\FormTreeHelper;
use Poppy\Framework\Helper\ImgHelper;
use Poppy\System\Classes\Layout\Content;
use Poppy\System\Http\Request\Web\WebController;

/**
 * 内容生成器
 */
class HelperController extends WebController
{

    /**
     * 主页
     * @return Content
     */
    public function env(): Content
    {
        return (new Content())->body(new FormEnvHelper());
    }

    public function image(): Content
    {
        return (new Content())->body(new FormImageHelper());
    }

    public function tree(): Content
    {
        return (new Content())->body(new FormTreeHelper());
    }


    public function imgStr()
    {
        ImgHelper::buildStr('Qianqian Li');
    }

    public function imgBmp()
    {
        $gd = imagecreatefrombmp(poppy_path('demo', 'tests/files/bear.bmp'));
        header("Content-type:image/jpg");
        imagepng($gd);
        imagedestroy($gd);
    }

    public function form(): Content
    {
        $content = new Content();
        $content->title('表单示例')
            ->description('这里列出了所有表单的可能性的选项')
            ->body(new FormEntrance());
        return $content;
    }
}