<?php

namespace Poppy\MgrApp\Form\Field;

use Poppy\MgrApp\Form\FormItem;

class File extends FormItem
{
    public function image()
    {
        $this->options['type'] = 'images';
        return $this;
    }

    public function file()
    {
        $this->options['type'] = 'file';
        return $this;
    }

    public function audio()
    {
        $this->options['type'] = 'audio';
        return $this;
    }

    public function video()
    {
        $this->options['type'] = 'video';
        return $this;
    }

    /**
     * 自定义扩展
     * @param array $exts
     * @return File
     */
    public function exts(array $exts = [])
    {
        $this->options['exts'] = $exts;
        return $this;
    }
}
