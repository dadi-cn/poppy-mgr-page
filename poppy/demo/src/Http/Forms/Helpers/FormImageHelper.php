<?php namespace Poppy\Demo\Http\Forms\Helpers;

use Poppy\Framework\Helper\ImgHelper;
use Poppy\System\Classes\Widgets\FormWidget;

class FormImageHelper extends FormWidget
{


    /**
     * 表单标题
     * @var string
     */
    public $title = 'ImageHelper';


    /**
     * Build a form here.
     */
    public function form()
    {
        $file = poppy_path('poppy.framework', 'tests/files/demo.jpeg');
        $this->text('typeFromMime', 'TypeFromMime')->default(ImgHelper::typeFromMime($file));
        // $this->text('imageCreateFromBmp', 'ImageCreateFromBmp')->default(ImgHelper::imageCreateFromBmp($file));
        // dd(ImgHelper::buildStr($file));
        $this->image('build-str', 'ImgBuildStr')->default(route_url('py-demo:web.helper.img_str'));
        $this->image('build-bmp', 'ImgBuildBmp')->default(route_url('py-demo:web.helper.img_bmp'));

    }
}
