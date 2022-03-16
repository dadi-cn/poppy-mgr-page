<?php


namespace Demo\App\Grid;

use Poppy\Framework\Exceptions\ApplicationException;
use Poppy\MgrApp\Http\Grid\GridBase;

/**
 * 快捷列表
 */
class GridQuick extends GridBase
{
    public string $title = '列快捷展示';

    /**
     * @inheritDoc
     * @throws ApplicationException
     */
    public function columns()
    {
        $this->column('id', 'QuickId')->quickId();
        $this->column('title', 'QuickTitle')->quickTitle();
        $this->column('title-large', 'QuickTitleLarge')->display(function () {
            return $this->title;
        })->quickTitle(true);
        $this->column('post_at', 'QuickDatetime')->quickDatetime();
    }
}
