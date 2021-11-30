<?php

namespace Demo\Http\Forms\Web;

use Poppy\Area\Action\Area;
use Poppy\Area\Models\SysArea;
use Poppy\Framework\Classes\Resp;
use Poppy\Framework\Exceptions\ApplicationException;
use Poppy\Framework\Validation\Rule;
use Poppy\MgrApp\Widgets\FormWidget;

class FormRuleDateEstablish extends FormWidget
{
    /**
     * @var SysArea
     */
    private $item;

    /**
     * 设置id
     * @param $id
     * @return $this
     */
    public function setId($id): self
    {
        $this->id = $id;

        if ($id) {
            $this->item = SysArea::find($this->id);
            if (!$this->item) {
                throw new ApplicationException('无地区信息');
            }
        }
        return $this;
    }


    public function handle()
    {
        $id   = input('id');
        $Area = new Area();
        if (is_post()) {
            if ($Area->establish(input(), $id)) {
                return Resp::success('添加版本成功', '_top_reload|1');
            }

            return Resp::error($Area->getError());
        }

        $id && $Area->initArea($id) && $Area->share();

    }

    public function data(): array
    {
        return [
            'id'    => 5,
            'title' => 'default title',
        ];
    }

    public function form()
    {
        $this->text('date', 'Date')->rules([
            Rule::date(),
        ]);
        $this->text('date-format', 'DateFormat')->rules([
            Rule::dateFormat('Y-m'),
        ]);
        $this->text('date-after', 'DateAfter')->rules([
            Rule::string(),
            Rule::after('date'),
        ]);
        $this->text('date-after_or_equal', 'DateAfterEqual')->rules([
            Rule::string(),
            Rule::afterOrEqual('date'),
        ]);
        $this->text('date-before', 'DateBefore')->rules([
            Rule::string(),
            Rule::before('date'),
        ]);
        $this->text('date-before_or_equal', 'DateBeforeEqual')->rules([
            Rule::string(),
            Rule::beforeOrEqual('date'),
        ]);

    }
}
