<?php

namespace Poppy\MgrApp\Form;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Validation\Factory;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Support\Fluent;
use Illuminate\Support\Str;
use Poppy\Framework\Helper\StrHelper;

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
     * 规则
     * @var array
     */
    protected array $rules = [];

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
     * @var string 标签
     */
    private string $label;

    /**
     * 验证器
     * @var mixed
     */
    private $validator;

    /**
     * 表单条目
     * @param string $name  名称/属性
     * @param string $label 标签名称
     */
    public function __construct(string $name, string $label)
    {
        $this->fieldAttr = new Fluent();

        $this->name  = $name;
        $this->label = $label;

        // element
        $this->type = StrHelper::slug(Str::afterLast(get_called_class(), '\\'));
    }

    /**
     * 设置验证规则
     * @param array $value
     * @return $this
     */
    public function rules(array $value): self
    {
        $this->rules = array_merge($value, $this->rules);
        return $this;
    }


    /**
     * 设置默认值, 当返回数据无此字段时候选择此值作为默认值
     * @param $value
     * @return FormItem
     */
    public function default($value): self
    {
        $this->default = $value;
        return $this;
    }

    public function disabled(): self
    {
        $this->setAttribute('disabled', true);
        return $this;
    }

    /**
     * 字段属性
     * @param $attr
     * @param $value
     * @return $this
     */
    public function setAttribute($attr, $value): self
    {
        $this->fieldAttr->offsetSet($attr, $value);
        return $this;
    }


    /**
     * 获取字段名字
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Get validator for this field.
     *
     * @param array $input
     *
     * @return false|Application|Factory|Validator
     */
    public function getValidator(array $input)
    {
        if ($this->validator) {
            return $this->validator->call($this, $input);
        }

        $rules = $attributes = [];

        if (!$fieldRules = $this->getRules()) {
            return false;
        }

        if (is_string($this->name)) {
            $rules[$this->name]      = $fieldRules;
            $attributes[$this->name] = $this->label;
        }

        return validator($input, $rules, [], $attributes);
    }

    /**
     * 返回当前表单字段的结构
     * @return array
     */
    public function struct(): array
    {
        return [
            'type'  => $this->type,
            'name'  => $this->name,
            'label' => $this->label,
            'field' => $this->attributes(),
            'rules' => collect($this->rules)->map(function ($rule) {
                return (string) $rule;
            })->toArray(),
        ];
    }

    /**
     * 默认数据值
     * @return mixed
     */
    public function getDefault()
    {
        return $this->default;
    }

    /**
     * 校验规则
     * @return array
     */
    protected function getRules(): array
    {
        return $this->rules;
    }

    /**
     * 获取属性
     * @param $attr
     * @return mixed
     */
    protected function getAttribute($attr)
    {
        return $this->fieldAttr->offsetGet($attr);
    }

    /**
     * 获取属性列表
     * @return object
     */
    protected function attributes(): object
    {
        return (object) $this->fieldAttr->toArray();
    }
}
