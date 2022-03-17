<?php


namespace Demo\App\Grid;

use Demo\Models\DemoWebapp;
use Poppy\Framework\Exceptions\ApplicationException;
use Poppy\MgrApp\Http\Grid\GridBase;

/**
 * 快捷列表
 * @mixin DemoWebapp
 */
class GridQuick extends GridBase
{
    public string $title = '列快捷展示';

    /**
     * @inheritDoc
     */
    public function columns()
    {
        $this->column('id', 'QuickId')->quickId();
        $this->column('title', 'QuickTitle')->quickTitle();
        $this->column('title-large', 'QuickTitleLarge')->display(function () {
            return $this->title;
        })->quickTitle(true);
        $this->column('color', '显示 Html 样式')->quickTitle(true)->html(function () {
            return "<div style='{$this->style}'>$this->title</div>";
        });
        $this->column('link', '链接')->link()->ellipsis();
        $this->column('pdf', 'Pdf')->download();
        $this->column('post_at', 'QuickDatetime')->quickDatetime();
    }
}
