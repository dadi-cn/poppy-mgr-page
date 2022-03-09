<?php

namespace Poppy\MgrApp\Classes\Action;


use Poppy\MgrApp\Classes\Contracts\Structable;

/**
 * @method self primary()       主要按钮
 * @method self success()       成功
 * @method self info()          信息
 * @method self warning()       警告
 * @method self danger()        危险
 * @method self disabled()      禁用
 * @method self plain()         朴素模式
 * @method self circle()        原型模式
 * @method self confirm()        原型模式
 */
abstract class Action implements Structable
{
    /**
     * 禁用
     * @var bool
     */
    protected bool $disabled = false;

    /**
     * 朴素模式
     * @var bool
     */
    protected bool $plain = false;

    /**
     * 圆形
     * @var bool
     */
    protected bool $circle = false;

    /**
     * 按钮的类型
     * @var string
     */
    protected string $type = '';

    /**
     * 大小
     * @var string
     */
    protected string $size = '';

    /**
     * icon
     * @var string
     */
    protected string $icon = '';

    /**
     * 是否只显示 ICON
     * @var bool
     */
    protected bool $only = false;

    /**
     * 是否进行请求前确认
     * @var bool
     */
    protected bool $confirm = false;

    /**
     * 请求方法
     * @var string
     */
    protected string $method;

    /**
     * 标题/说明
     * @var string
     */
    private string $title;

    /**
     * 请求的Url
     * @var string
     */
    private string $url;

    /**
     * 创建 Action
     * @param $title
     * @param $url
     */
    public function __construct($title, $url)
    {
        $this->title = $title;
        $this->url   = $url;
    }

    /**
     * 设置 ICON 图标
     * @param string $icon ICON 图标
     * @param bool   $only 是否仅仅显示ICON
     * @return $this
     */
    public function icon(string $icon, bool $only = false): self
    {
        $this->icon = $icon;
        $this->only = $only;
        return $this;
    }

    public function __call($method, $args)
    {
        if (in_array($method, [
            'primary', 'success', 'info', 'warning', 'danger'
        ])) {
            $this->type = $method;
            return $this;
        }

        if (in_array($method, [
            'disabled', 'plain', 'circle', 'confirm'
        ])) {
            $this->$method = true;
            return $this;
        }
        return $this;
    }

    public function struct(): array
    {
        $params = [
            'url'   => $this->url,
            'title' => $this->title,
        ];
        foreach (['type', 'plain', 'only', 'circle', 'icon', 'disabled', 'confirm'] as $value) {
            if ($this->{$value}) {
                $params[$value] = $this->{$value};
            }
        }
        return $params;
    }
}
