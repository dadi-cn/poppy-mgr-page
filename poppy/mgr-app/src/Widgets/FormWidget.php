<?php

namespace Poppy\MgrApp\Widgets;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Fluent;
use Illuminate\Support\MessageBag;
use Illuminate\Validation\Validator;
use Poppy\Framework\Classes\Resp;
use Poppy\Framework\Classes\Traits\PoppyTrait;
use Poppy\Framework\Exceptions\ApplicationException;
use Poppy\Framework\Helper\ArrayHelper;
use Poppy\MgrApp\Form\Field\Checkbox;
use Poppy\MgrApp\Form\Field\Color;
use Poppy\MgrApp\Form\Field\Currency;
use Poppy\MgrApp\Form\Field\Date;
use Poppy\MgrApp\Form\Field\DateRange;
use Poppy\MgrApp\Form\Field\Datetime;
use Poppy\MgrApp\Form\Field\DatetimeRange;
use Poppy\MgrApp\Form\Field\Decimal;
use Poppy\MgrApp\Form\Field\Email;
use Poppy\MgrApp\Form\Field\Image;
use Poppy\MgrApp\Form\Field\Ip;
use Poppy\MgrApp\Form\Field\Mobile;
use Poppy\MgrApp\Form\Field\Month;
use Poppy\MgrApp\Form\Field\MonthRange;
use Poppy\MgrApp\Form\Field\MultiImage;
use Poppy\MgrApp\Form\Field\MultiSelect;
use Poppy\MgrApp\Form\Field\Number;
use Poppy\MgrApp\Form\Field\OnOff;
use Poppy\MgrApp\Form\Field\Password;
use Poppy\MgrApp\Form\Field\Radio;
use Poppy\MgrApp\Form\Field\Select;
use Poppy\MgrApp\Form\Field\Tags;
use Poppy\MgrApp\Form\Field\Text;
use Poppy\MgrApp\Form\Field\Textarea;
use Poppy\MgrApp\Form\Field\Time;
use Poppy\MgrApp\Form\Field\TimeRange;
use Poppy\MgrApp\Form\Field\Url;
use Poppy\MgrApp\Form\Field\Year;
use Poppy\MgrApp\Form\FieldDef;
use Poppy\MgrApp\Form\FormItem;

/**
 * Form Widget
 * @url https://element-plus.gitee.io/zh-CN/component/form.html#form-attributes
 * @method Text text($name, $label = '')
 * @method Textarea textarea($name, $label = '')
 * @method Url url($name, $label = '')
 * @method Password password($name, $label = '')
 * @method Mobile mobile($name, $label = '')
 * @method Ip ip($name, $label = '')
 * @method Decimal decimal($name, $label = '')
 * @method Currency currency($name, $label = '')
 * @method Email email($name, $label = '')
 * @method Number number($name, $label = '')
 * @method Radio radio($name, $label = '')
 * @method Checkbox checkbox($name, $label = '')
 * @method Select select($name, $label = '')
 * @method MultiSelect multiSelect($name, $label = '')
 * @method Tags tags($name, $label = '')
 * @method Color color($name, $label = '')
 * @method Year year($name, $label = '')
 * @method Month month($name, $label = '')
 * @method Date date($name, $label = '')
 * @method Datetime datetime($name, $label = '')
 * @method Time time($name, $label = '')
 * @method DateRange dateRange($name, $label = '')
 * @method MonthRange monthRange($name, $label = '')
 * @method DatetimeRange datetimeRange($name, $label = '')
 * @method TimeRange timeRange($name, $label = '')
 * @method OnOff onOff($name, $label = '')
 * @method Image image($name, $label = '')
 * @method MultiImage multiImage($name, $label = '')
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

    public abstract function handle();

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
            throw new ApplicationException("Field `${method}` not exists");
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

    /**
     * 返回表单的结构
     * 规则解析参考 : https://github.com/yiminghe/async-validator
     */
    public function resp()
    {
        $request = app('request');
        // 组建 Form 表单
        $this->form();
        if ($request->method() === 'GET') {
            $this->handle();
            $this->fill($this->data());
            $items = new Collection();
            $model = new Fluent();
            $this->items->each(function (FormItem $item) use ($items, $model) {
                $struct = $item->struct();
                $items->push($struct);
                $model->offsetSet($item->getName(), $this->model[$item->getName()] ?? $item->getDefault());
            });
            return Resp::success('结构化数据', [
                'title'       => $this->title,
                'description' => $this->description,
                'buttons'     => $this->buttons,
                'model'       => (object) $model->toArray(),
                'attr'        => (object) $this->attrs->toArray(),
                'items'       => $items->toArray(),
            ]);
        }
        if ($request->method() === 'POST') {
            $message = $this->validate($request);
            if ($message instanceof MessageBag) {
                return Resp::error($message);
            }
            return $this->handle();
        }
        return Resp::error('错误的请求');
    }

    /**
     * Validate this form fields.
     *
     * @param Request $request
     *
     * @return bool|MessageBag
     */
    protected function validate(Request $request)
    {
        $failed = [];

        foreach ($this->items() as $field) {
            if (!$validator = $field->getValidator($request->all())) {
                continue;
            }

            if (($validator instanceof Validator) && !$validator->passes()) {
                $failed[] = $validator;
            }
        }

        $messageBag = new MessageBag();
        foreach ($failed as $valid) {
            $messageBag = $messageBag->merge($valid->messages());
        }
        return $messageBag->any() ? $messageBag : false;
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
}
