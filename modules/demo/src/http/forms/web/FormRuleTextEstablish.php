<?php

namespace Demo\Http\Forms\Web;

use Poppy\Area\Action\Area;
use Poppy\Area\Models\SysArea;
use Poppy\Framework\Classes\Resp;
use Poppy\Framework\Exceptions\ApplicationException;
use Poppy\Framework\Validation\Rule;
use Poppy\MgrApp\Widgets\FormWidget;

class FormRuleTextEstablish extends FormWidget
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
            'str' => 'default str',
        ];
    }

    public function form()
    {
        $this->text('str', '文本:必填')->rules([
            Rule::required(),
        ]);
        $this->text('str_con', '文本:Con')->rules([
            Rule::confirmed(),
        ]);
        $this->text('str_same', '文本:Same(Con)')->rules([
            Rule::same('str_con'),
        ]);
        $this->text('str_con_confirmation', '文本:Confirm');
        $this->text('str_start_with', '文本:StartsWith')->rules([
            Rule::startsWith('Z'),
        ]);
        $this->text('str_ends_with', '文本:EndsWith')->rules([
            Rule::endsWith('Q'),
        ]);
        $this->text('str-ip', '文本:IP')->rules([
            Rule::ip(),
        ]);
        $this->text('str-ipv4', '文本:IPv4')->rules([
            Rule::ipv4(),
        ]);
        $this->text('str-ipv6', '文本:IPv6')->rules([
            Rule::ipv6(),
        ]);
        $this->text('str-email', '文本:Email')->rules([
            Rule::email(),
        ]);
        $this->text('str-alpha', '文本:alpha')->rules([
            Rule::alpha(),
        ]);
        $this->text('str-url', '文本:Url')->rules([
            Rule::url(),
        ]);
        $this->text('str-alpha-dash', '文本:alpha-dash')->rules([
            Rule::alphaDash(),
        ]);
        $this->text('str-alpha-num', '文本:alpha-num')->rules([
            Rule::alphaNum(),
        ]);
        $this->text('str-integer', '文本:integer')->rules([
            Rule::integer(),
        ]);
        $this->text('str-max', '文本:(Max20)')->rules([
            Rule::string(),
            Rule::max(20),
        ]);
        $this->text('str-min', '文本:(Min5)')->rules([
            Rule::string(),
            Rule::min(5),
        ]);
        $this->text('str-between', '文本:(5-10)')->rules([
            Rule::string(),
            Rule::between(5, 10),
        ]);
        $this->text('str-size', '文本:(5)')->rules([
            Rule::string(),
            Rule::size(5),
        ]);
        $this->text('str-json', '文本:Json')->rules([
            Rule::string(),
            Rule::json(),
        ]);
        $this->text('str-in', '文本:In')->rules([
            Rule::string(),
            Rule::in(['a', 'b', 'c']),
        ]);
        $this->text('str-not_in', '文本:NotIn')->rules([
            Rule::string(),
            Rule::notIn(['a', 'b', 'c']),
        ]);
        $this->text('number', '数字')->rules([
            Rule::numeric(),
        ]);
        $this->text('number-max', '数字(Max100)')->rules([
            Rule::numeric(),
            Rule::max(100),
        ]);
        $this->text('number-max-digit', '数字(Max4.28)')->rules([
            Rule::numeric(),
            Rule::max(4.28),
        ]);
        $this->text('number-min', '数字(Min20)')->rules([
            Rule::numeric(),
            Rule::min(20),
        ]);
        $this->text('number-min-digit', '数字(Min2.5)')->rules([
            Rule::numeric(),
            Rule::min(2.5),
        ]);
        $this->text('number-digits', '数字(Digits:8)')->rules([
            Rule::digits(8),
        ]);
        $this->text('number-digits_between', '数字(Digits:3-9)')->rules([
            Rule::digitsBetween(3, 9),
        ]);
        $this->text('number-between', '数字(20-100)')->rules([
            Rule::numeric(),
            Rule::between(20, 100),
        ]);
        $this->text('number-between-digit', '数字(2.5-8)')->rules([
            Rule::numeric(),
            Rule::between(2.5, 8),
        ]);
        $this->text('number-size', '数字(5)')->rules([
            Rule::numeric(),
            Rule::size(5),
        ]);
    }
}
