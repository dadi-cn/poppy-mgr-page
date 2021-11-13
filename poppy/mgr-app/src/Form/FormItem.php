<?php

namespace Poppy\MgrApp\Form;

use Illuminate\Support\Fluent;
use Illuminate\Support\Str;
use Poppy\Framework\Helper\StrHelper;
use Poppy\Framework\Validation\Rule;

/**
 * 表单条目
 */
abstract class FormItem
{
    /**
     * 默认的数据
     * @var mixed
     */
    protected $default;

    /**
     * 表单条目属性
     * @var Fluent
     */
    private Fluent $itemAttr;

    /**
     * 字段的属性
     * @var Fluent
     */
    private Fluent $fieldAttr;

    /**
     * 字段名字
     * @var string
     */
    private string $name;

    /**
     * 对应的表单组件的类型
     * 使用的类名转换的中杠线
     * @var string
     */
    private string $type;

    /**
     * 规则
     * @var array
     */
    private array $rules = [];

    /**
     * 表单条目
     * @param string $name  名称/属性
     * @param string $label 标签名称
     */
    public function __construct(string $name, string $label)
    {
        $this->itemAttr  = new Fluent();
        $this->fieldAttr = new Fluent();

        $this->name = $name;

        // element
        $this->fieldAttr->offsetSet('name', $name);
        $this->itemAttr->offsetSet('label', $label);
        $this->type = StrHelper::slug(Str::afterLast(get_called_class(), '\\'));
    }

    /**
     * 字段属性
     * @param $attr
     * @param $value
     */
    public function fieldAttr($attr, $value)
    {
        $this->fieldAttr->offsetSet($attr, $value);
    }

    /**
     * 标签的宽度
     * @param mixed $width 宽度, 例如 50px|auto|50
     * @return $this
     */
    public function itemLabelWidth($width): self
    {
        $this->itemAttr->offsetSet('label-width', $width);
        return $this;
    }

    /**
     * 设置验证规则
     * @param array $value
     * @return $this
     */
    public function rules(array $value): self
    {
        $this->rules = $value;
        return $this;
    }

    /**
     * 字段错误信息, 验证错误显示的信息
     * @param string $value
     * @return $this
     */
    public function itemError(string $value): self
    {
        $this->itemAttr->offsetSet('error', $value);
        return $this;
    }

    /**
     * 是否显示错误信息
     * @param bool $value
     * @return $this
     */
    public function itemShowMessage(bool $value): self
    {
        $this->itemAttr->offsetSet('show-message', $value);
        return $this;
    }

    /**
     * 是否在行内显示错误信息
     * @param bool $value
     * @return $this
     */
    public function itemInlineMessage(bool $value): self
    {
        $this->itemAttr->offsetSet('inline-message', $value);
        return $this;
    }

    /**
     * 获取字段名字
     * @return string
     */
    public function name(): string
    {
        return $this->name;
    }

    /**
     * 默认数据值
     * @return mixed
     */
    public function default()
    {
        return $this->default;
    }

    /**
     * 校验规则
     * @return array
     */
    public function getRules():array
    {
        return $this->rules;
    }

    /**
     * 返回当前表单字段的结构
     * @return array
     */
    public function struct(): array
    {
        return [
            'type'  => $this->type,
            'item'  => $this->itemAttr->toArray(),
            'field' => $this->fieldAttr->toArray(),
        ];
    }
}
