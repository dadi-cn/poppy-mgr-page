<?php namespace Poppy\Demo\Forms;

use Poppy\Framework\Validation\Rule;
use Poppy\System\Models\PamAccount;

class FormImage extends FormBaseWidget
{


    /**
     * 表单标题
     * @var string
     */
    public $title = 'Image';

    public function data()
    {
        return [
            'image_rec'        => 'https://fakeimg.pl/640x480/282828/eae0d0/',
            'image_rec_r'      => 'https://fakeimg.pl/480x640/282828/eae0d0/',
            'image_square'     => 'https://fakeimg.pl/480/282828/eae0d0/',
            'image_max_width'  => 'https://fakeimg.pl/2222x460/282828/eae0d0/',
            'image_max_height' => 'https://fakeimg.pl/460x2222/282828/eae0d0/',
        ];
    }

    /**
     * Build a form here.
     */
    public function form()
    {
        $token = app('tymon.jwt.auth')->fromUser(PamAccount::first());
        $this->image('image', '图片, 默认, 可上传')->rules([
            Rule::required(),
        ])->token($token);
        // 添加 code 代码
        $code = <<<CODE
\$token = app('tymon.jwt.auth')->fromUser(PamAccount::first());
\$this->image('image', '图片, 默认, 可上传')->rules([
	Rule::required(),
])->token($token);
CODE;
        $this->code('image-code', 'Code@图片, 默认, 可上传')->default($code);
        $this->divider();

        // 图片大小演示
        $this->image('image_rec_r', '图片小组件')
            ->size('small')
            ->help('未设置Token, 无法上传; 默认竖向图片比较宽, 图片展示组件是小型 : small');
        // 添加 code 代码
        $code = <<<CODE
\$this->image('image_rec_r', '图片小组件')
	->size('small')
	->help('未设置Token, 无法上传; 默认竖向图片比较宽, 图片展示组件是小型 : small');
CODE;
        $this->code('image_rec_r-code', 'Code@图片小组件')->default($code);
        $this->divider();

        $this->image('image_square', '图片标准组件')
            ->help('未设置Token, 无法上传; 默认方形图片, 图片展示组件是标准大小 : normal');
        // 添加 code 代码
        $code = <<<CODE
\$this->image('image_square', '图片标准组件')
	->help('未设置Token, 无法上传; 默认方形图片, 图片展示组件是标准大小 : normal');
CODE;
        $this->code('image_square-code', 'Code@图片标准组件')->default($code);
        $this->divider();

        $this->image('image_rec', '图片大组件')
            ->size('large')
            ->help('未设置Token, 无法上传; 默认横向图片比较宽, 图片展示组件是大型 : large');
        // 添加 code 代码
        $code = <<<CODE
\$this->image('image_rec', '图片大组件')
	->size('large')
	->help('未设置Token, 无法上传; 默认横向图片比较宽, 图片展示组件是大型 : large');
CODE;
        $this->code('image_rec-code', 'Code@图片大组件')->default($code);
        $this->divider();

        $this->image('image_max_width', '超宽图')
            ->help('超宽图预览');
        // 添加 code 代码
        $code = <<<CODE
\$this->image('image_max_width', '超宽图')
	->help('超宽图预览');
CODE;
        $this->code('image_max_width-code', 'Code@超宽图')->default($code);
        $this->divider();

        $this->image('image_max_height', '超高图')
            ->help('超高图预览');
        // 添加 code 代码
        $code = <<<CODE
\$this->image('image_max_height', '超高图')
	->help('超高图预览');
CODE;
        $this->code('image_max_height-code', 'Code@超高图')->default($code);

    }
}