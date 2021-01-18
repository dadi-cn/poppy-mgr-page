<?php namespace Poppy\Demo\Http\Request\Web;

use Poppy\Demo\Forms\FormEntrance;
use Poppy\Demo\Http\Forms\Helpers\FormEnvHelper;
use Poppy\Demo\Http\Forms\Helpers\FormImageHelper;
use Poppy\Demo\Http\Forms\Helpers\FormTreeHelper;
use Poppy\Framework\Helper\ImgHelper;
use Poppy\System\Classes\Layout\Content;
use Poppy\System\Http\Request\Web\WebController;
use Response;

/**
 * 内容生成器
 */
class HelperController extends WebController
{

    /**
     * 主页
     * @return Content
     */
    public function env()
    {
        return (new Content())->body(new FormEnvHelper());
    }

    public function image()
    {
        return (new Content())->body(new FormImageHelper());
    }

    public function tree()
    {
        return (new Content())->body(new FormTreeHelper());
    }

    public function imgStr()
    {
        ob_clean();
        ImgHelper::buildStr('Qianqian Li');
        $content = ob_get_clean();
        return Response::make($content, 200, [
            'Content-Type'  => 'image/png',
            'Cache-Control' => 'no-cache, must-revalidate',
        ]);
    }

    public function imgBmp()
    {
        $gd = ImgHelper::imageCreateFromBmp(poppy_path('poppy.demo', 'tests/files/bear.bmp'));
        ob_clean();
        header("Content-type:image/jpg");
        imagepng($gd);
        imagedestroy($gd);
        $content = ob_get_clean();
        return Response::make($content);
    }

    public function form()
    {
        $content = new Content();
        $content->title('表单示例')
            ->description('这里列出了所有表单的可能性的选项')
            ->body(new FormEntrance());
        return $content;
    }
}