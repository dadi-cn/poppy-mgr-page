<?php


namespace Poppy\MgrApp\Form\Traits;

use Illuminate\Support\Str;

trait UseInput
{
    public function disabled(): self
    {
        $this->setAttribute('disabled', true);
        return $this;
    }


    public function placeholder($ph): self
    {
        $this->setAttribute('placeholder', $ph);
        return $this;
    }

    /**
     * 显示输入字符限制
     * @return $this
     */
    public function showWordLimit(): self
    {
        $this->setAttribute('show-word-limit', true);
        return $this;
    }


    protected function attributes(): object
    {
        // 解析 max 规则, 匹配属性
        collect($this->rules)->each(function ($rule) {
            if (Str::startsWith($rule, 'max')) {
                $max = Str::after($rule, 'max:');
                $this->setAttribute('maxlength', $max);
            }
        });
        return parent::attributes();
    }
}
