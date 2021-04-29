<?php

namespace Poppy\Area\Http\Forms\Backend;

use Poppy\Area\Action\Area;
use Poppy\Area\Models\SysArea;
use Poppy\Framework\Classes\Resp;
use Poppy\Framework\Exceptions\ApplicationException;
use Poppy\Framework\Validation\Rule;
use Poppy\SensitiveWord\Action\Word;
use Poppy\SensitiveWord\Models\SysSensitiveWord;
use Poppy\System\Classes\Traits\PamTrait;
use Poppy\System\Classes\Widgets\FormWidget;

class FormAreaEstablish extends FormWidget
{
    use PamTrait;

    public $ajax = true;

    private $id;

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
            $this->item = SysSensitiveWord::find($this->id);
            if (!$this->item) {
                throw new ApplicationException('无敏感词信息');
            }
        }
        return $this;
    }


    public function handle()
    {
        $Word = new Word();
        $Word->setPam(request()->user());
        if (is_post()) {
            if (!$Word->establish(input(), input('id'))) {
                return Resp::error($Word->getError());
            }
            return Resp::success('操作成功', '_top_reload|1');
        }

    }

    public function data(): array
    {
        if ($this->item) {
            return [
                'id'   => $this->item->id,
                'word' => $this->item->word,
            ];
        }
        return [];
    }

    public function form()
    {
        if ($this->id) {
            $this->hidden('id', 'ID');
        }

        $this->text('title', '地区名称')->rules([
            Rule::nullable(),
        ]);
        $this->select('top_id','选择省级')->rules([

        ]);
    }

    /**
     * 更新
     */
    public function fix()
    {
        return (new Area())->fixHandle();
    }

    /**
     * 版本Action
     * @return Area
     */
    private function actArea(): Area
    {
        return (new Area())->setPam($this->pam);
    }
}
