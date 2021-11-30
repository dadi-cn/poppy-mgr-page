<?php

namespace Demo\Http\Forms\Web;

use Poppy\Area\Action\Area;
use Poppy\Area\Models\SysArea;
use Poppy\Framework\Classes\Resp;
use Poppy\Framework\Exceptions\ApplicationException;
use Poppy\Framework\Validation\Rule;
use Poppy\MgrApp\Widgets\FormWidget;

class FormRuleRequiredEstablish extends FormWidget
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
            'id'  => 5,
            'str' => 'default title',
        ];
    }

    public function form()
    {
        $this->text('str', '文本:必填')->rules([
            Rule::required(),
        ]);
        $this->text('required', 'Required:(Bool)')->rules([
            Rule::requiredIf(true),
        ]);
        $this->text('required-if', 'RequiredIf:(Str:a,b,c)')->rules([
            Rule::requiredIf('str', ['a', 'b', 'c']),
        ]);
        $this->text('required-unless', 'RequiredUnless:(Str:a,b,c)')->rules([
            Rule::requiredUnless('str', ['a', 'b', 'c']),
        ]);
        $this->text('a', 'RequiredBase:A')->rules([

        ]);
        $this->text('b', 'RequiredBase:B')->rules([

        ]);
        $this->text('required-with', 'With:(a,b)')->rules([
            Rule::requiredWith('a,b'),
        ]);
        $this->text('required-with-all', 'WithAll:(a,b)')->rules([
            Rule::requiredWithAll(['a', 'b']),
        ]);
        $this->text('required-without', 'Without:(a,b)')->rules([
            Rule::requiredWithout(['a', 'b']),
        ]);
        $this->text('required-without-all', 'WithoutAll:(a,b)')->rules([
            Rule::requiredWithoutAll(['a', 'b']),
        ]);
    }
}
