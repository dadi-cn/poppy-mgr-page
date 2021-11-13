<?php

namespace Poppy\MgrApp\Widgets;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Fluent;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Str;
use Illuminate\Validation\Validator;
use Poppy\Framework\Classes\Traits\PoppyTrait;
use Poppy\Framework\Exceptions\ApplicationException;
use Poppy\Framework\Helper\ArrayHelper;
use Poppy\Framework\Validation\Rule;
use Poppy\MgrApp\Form\Field\Hidden;
use Poppy\MgrApp\Form\Field\Text;
use Poppy\MgrApp\Form\FieldDef;
use Poppy\MgrApp\Form\FormItem;

/**
 * Form Widget
 * @url https://element-plus.gitee.io/zh-CN/component/form.html#form-attributes
 * @method Hidden hidden($name, $label = '')
 * @method Text text($name, $label = '')
 */
abstract class FormWidget
{
    use PoppyTrait;

    /**
     * 表单标题
     * @var string
     */
    protected string $title = '';

    protected string $description = '';

    /**
     * 表单内的表单条目集合
     * @var Collection
     */
    protected Collection $items;

    /**
     * 模型数据
     * @var array
     */
    protected array $model = [];

    /**
     * 表单属性
     * @var Fluent
     */
    protected Fluent $attrs;

    /**
     * 可用的按钮
     * @var array
     */
    protected array $buttons = ['reset', 'submit'];


    /**
     * Form constructor.
     */
    public function __construct()
    {
        $this->attrs = new Fluent();
        $this->items = new Collection();

        // 默认是非行内模式, 默认宽度
        $this->attrs->offsetSet('label-width', 'auto');
    }

    public abstract function form();

    public abstract function data(): array;

    /**
     * 用于控制该表单内组件的尺寸
     * @param string $size medium|small|mini
     * @return $this
     */
    public function size(string $size = ''): self
    {
        $this->attrs->offsetSet('size', $size);
        return $this;
    }

    /**
     * 表单域标签的宽度，例如 '50px'。 作为 Form 直接子元素的 form-item 会继承该值。 支持 auto
     * @param string $width
     */
    public function labelWidth(string $width)
    {
        $this->attrs->offsetSet('label-width', $width);
    }

    /**
     * Disable reset button.
     * @return $this
     */
    public function disableReset(): self
    {
        ArrayHelper::delete($this->buttons, 'reset');
        return $this;
    }

    /**
     * Disable submit button.
     *
     * @return $this
     */
    public function disableSubmit(): self
    {
        ArrayHelper::delete($this->buttons, 'submit');
        return $this;
    }


    /**
     * 行内表单模式, 取消自动宽度, 进行宽度自适应
     * @return $this
     */
    public function inline(): self
    {
        $this->attrs->offsetSet('inline', true);
        $this->attrs->offsetSet('label-width', '');
        return $this;
    }

    /**
     * 表单域标签的位置， 如果值为 left 或者 right 时，则需要设置 label-width
     * @param bool $position
     * @return $this
     */
    public function labelPosition(bool $position): self
    {
        $this->attrs->offsetSet('label-position', $position);
        return $this;
    }

    /**
     * 表单域标签的后缀
     * @param bool $value
     * @return $this
     */
    public function labelSuffix(bool $value): self
    {
        $this->attrs->offsetSet('label-suffix', $value);
        return $this;
    }

    /**
     * 是否显示必填字段的标签旁边的红色星号
     * @return $this
     */
    public function hideRequiredAsterisk(): self
    {
        $this->attrs->offsetSet('hide-required-asterisk', true);
        return $this;
    }

    /**
     * 是否显示校验错误信息
     * @param bool $value
     * @return $this
     */
    public function showMessage(bool $value): self
    {
        $this->attrs->offsetSet('show-message', $value);
        return $this;
    }

    /**
     * 是否以行内形式展示校验信息
     * @param bool $value
     * @return $this
     */
    public function inlineMessage(bool $value): self
    {
        $this->attrs->offsetSet('inline-message', $value);
        return $this;
    }

    /**
     * 是否在输入框中显示校验结果反馈图标， default：false
     * @param bool $value
     * @return $this
     */
    public function statusIcon(bool $value): self
    {
        $this->attrs->offsetSet('status-icon', $value);
        return $this;
    }

    /**
     * 是否在 rules 属性改变后立即触发一次验证
     * @param bool $value
     * @return $this
     */
    public function validateOnRuleChange(bool $value): self
    {
        $this->attrs->offsetSet('validate-on-rule-change', $value);
        return $this;
    }


    /**
     * 是否禁用该表单内的所有组件。 若设置为 true，则表单内组件上的 disabled 属性不再生效
     * @param bool $value
     * @return $this
     */
    public function disabled(bool $value): self
    {
        $this->attrs->offsetSet('disabled', $value);
        return $this;
    }

    /**
     * 向服务器添加字段
     * @param FormItem $item
     * @return $this
     */
    public function addItem(FormItem $item): self
    {
        $this->items->push($item);
        return $this;
    }

    /**
     * 获取表单的所有字段
     * @return FormItem[]|Collection
     */
    public function items(): Collection
    {
        return $this->items;
    }

    /**
     * Validate this form fields.
     *
     * @param Request $request
     *
     * @return bool|MessageBag
     */
    public function validate(Request $request)
    {
        $failedValidators = [];

        foreach ($this->items() as $field) {
            if (!$validator = $field->getValidator($request->all())) {
                continue;
            }

            if (($validator instanceof Validator) && !$validator->passes()) {
                $failedValidators[] = $validator;
            }
        }

        $message = $this->mergeValidationMessages($failedValidators);
        return $message->any() ? $message : false;
    }

    /**
     * Generate items and append to form list
     * @param string $method    类型
     * @param array  $arguments 传入的参数
     *
     * @return FormItem|$this
     * @throws ApplicationException
     */
    public function __call(string $method, array $arguments = [])
    {
        $name  = (string) Arr::get($arguments, 0);
        $label = (string) Arr::get($arguments, 1);
        if (is_array($name) || is_array($label)) {
            throw new ApplicationException("Method `${method}` Cannot use array arguments.");
        }
        $field = FieldDef::create($method, $name, $label);
        if (is_null($field)) {
            return $this;
        }
        return tap($field, function ($field) {
            $this->addItem($field);
        });
    }

    /**
     * 设置表单的标题
     * @param string $value
     * @param string $description
     * @return FormWidget
     */
    public function title(string $value, string $description = ''): self
    {
        $this->title       = $value;
        $this->description = $description;
        return $this;
    }

    public function fetchSkeleton(): array
    {
        collect($this->items())->each->fill($this->data());

        $fields = [];
        foreach ($this->items() as $field) {
            $variable = $field->variables();
            $opts     = [
                'name'        => $variable['name'],
                'type'        => $field->getType(),
                'value'       => $variable['value'],
                'label'       => $variable['label'],
                'placeholder' => $variable['placeholder'],
                'rules'       => $variable['rules'],
                'help'        => $variable['help']['text'] ?? '',
            ];

            // options
            $options = (array) $variable['options'];
            if (count($options)) {
                $newOption = [];
                foreach ($options as $key => $option) {
                    $newOption[] = [
                        'key'   => $key,
                        'value' => $option,
                    ];
                }
                $options = $newOption;
                $opts    = array_merge($opts, [
                    'options' => $options,
                ]);
            }
            $fields[] = array_merge($opts, $field->skeleton());

        }
        return [
            'type'    => 'form',
            'title'   => $this->title,
            'fields'  => $fields,
            'action'  => $this->attrs['action'],
            'method'  => $this->attrs['method'],
            'buttons' => $this->buttons,
        ];
    }

    /**
     * 返回表单的结构
     * 规则解析参考 : https://github.com/yiminghe/async-validator
     */
    public function struct(): array
    {
        // 组建 Form 表单
        $this->form();
        $this->fill($this->data());
        $rules = new Fluent();
        $items = new Collection();
        $model = new Fluent();
        $this->items->each(function (FormItem $item) use ($rules, $items, $model) {
            $itemRules = $item->getRules();
            if ($itemRules) {
                $rules->offsetSet($item->name(), $item->getRules());
            }
            $items->push($item->struct());
            $model->offsetSet($item->name(), $this->model[$item->name()] ?? $item->default());
        });
        return [
            'title'       => $this->title,
            'description' => $this->description,
            'buttons'     => $this->buttons,
            'model'       => (object) $model->toArray(),
            'attr'        => (object) $this->attrs->toArray(),
            'rules'       => $rules->toArray(),
            'items'       => $items->toArray(),
        ];
    }

    /**
     * Get variables for render form.
     *
     * @return array
     */
    protected function getVariables(): array
    {
        collect($this->items())->each->fill($this->data());

        return [
            'fields'     => $this->items,
            'validation' => $this->getJqValidation(),
            'action'     => $this->attrs['action'],
            'method'     => $this->attrs['method'],
            'buttons'    => $this->buttons,
            'id'         => $this->attrs['id'],
        ];
    }

    /**
     * Merge validation messages from input validators.
     *
     * @param Validator[] $validators
     *
     * @return MessageBag
     */
    protected function mergeValidationMessages($validators)
    {
        $messageBag = new MessageBag();

        foreach ($validators as $validator) {
            $messageBag = $messageBag->merge($validator->messages());
        }

        return $messageBag;
    }

    /**
     * Fill data to form fields.
     *
     * @param array $data
     * @return $this
     */
    private function fill(array $data = []): self
    {
        if ($data instanceof Arrayable) {
            $data = $data->toArray();
        }

        if (!empty($data)) {
            $this->model = $data;
        }

        return $this;
    }

    /**
     * 获取 Jquery Validation
     * @return false|string
     */
    private function getJqValidation()
    {
        $rules    = [];
        $messages = [];

        $funJqRules = function (array $rules, FormItem $field) {
            $jqRules = [];
            foreach ($rules as $rule) {
                if ($rule === Rule::required()) {
                    $jqRules['required'] = true;
                }
                if ($rule === Rule::numeric()) {
                    $jqRules['number'] = true;
                }
                if ($rule === Rule::email()) {
                    $jqRules['email'] = true;
                }
                if ($rule === Rule::mobile()) {
                    $jqRules['mobile'] = true;
                }
                if ($rule === Rule::ip()) {
                    $jqRules['ipv4'] = true;
                }
                if ($rule === Rule::url()) {
                    $jqRules['url'] = true;
                }
                if ($rule === Rule::alpha()) {
                    $jqRules['alpha'] = true;
                }
                if ($rule === Rule::alphaDash()) {
                    $jqRules['alpha_dash'] = true;
                }
                // 相等判定
                if (Str::contains($field->column(), '_confirmation')) {
                    $jqRules['equalTo'] = '#' . Str::replaceLast('_confirmation', '', $field->formatName($field->column()));
                }
                if (Str::contains($rule, 'regex')) {
                    $rule             = Str::replaceFirst('/', '', Str::after($rule, 'regex:'));
                    $jqRules['regex'] = Str::replaceLast('/', '', $rule);
                }

                if (in_array(Rule::numeric(), $rules)) {
                    if (in_array('min', $rules)) {
                        $jqRules['min'] = (int) Str::after($rule, 'min:');
                    }
                }

                if (Str::contains($rule, 'min')) {
                    if (in_array(Rule::numeric(), $rules)) {
                        $jqRules['min'] = (int) Str::after($rule, 'min:');
                    }
                    else {
                        $jqRules['minlength'] = (int) Str::after($rule, 'min:');
                    }
                }
                if (Str::contains($rule, 'max')) {
                    if (in_array(Rule::numeric(), $rules)) {
                        $jqRules['max'] = (int) Str::after($rule, 'max:');
                    }
                    else {
                        $jqRules['maxlength'] = (int) Str::after($rule, 'max:');
                    }
                }
            }


            return $jqRules;
        };
        collect($this->items())->each(function (FormItem $field) use (&$rules, &$messages, $funJqRules) {
            if (count($field->getRules())) {
                $jqRules = $funJqRules($field->getRules(), $field);
                if (count($jqRules)) {
                    $name = $field->formatName($field->column());
                    if ($field instanceof Field\Checkbox) {
                        $name .= '[]';
                    }
                    $rules[$name] = $jqRules;
                }
            }

            if (count($field->getValidationMessages())) {
                $messages[$field->column()] = $field->getValidationMessages();
            }
        });

        $jqValidation = [
            'rules'    => $rules,
            'messages' => $messages,
        ];
        return json_encode($jqValidation, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    }
}
