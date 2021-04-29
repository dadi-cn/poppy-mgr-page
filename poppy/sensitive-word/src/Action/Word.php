<?php

namespace Poppy\SensitiveWord\Action;

use Exception;
use Illuminate\Support\Str;
use Poppy\Framework\Classes\Traits\AppTrait;
use Poppy\Framework\Validation\Rule;
use Poppy\SensitiveWord\Models\SysSensitiveWord;
use Poppy\System\Classes\Traits\PamTrait;
use Throwable;
use Validator;

/**
 * 地区
 */
class Word
{
    use AppTrait, PamTrait;

    /**
     * @var SysSensitiveWord
     */
    protected $item;

    /**
     * @var string
     */
    protected $wordTable;

    public function __construct()
    {
        $this->wordTable = (new SysSensitiveWord())->getTable();
    }

    /**
     * 编辑/创建
     * @param array $data
     * @param null  $id
     * @return bool
     */
    public function establish(array $data, $id = null): bool
    {
        if (!$this->checkPam()) {
            return false;
        }

        $initDb    = [
            'word' => trim((string) data_get($data, 'word', '')),
        ];
        $validator = Validator::make($initDb, [
            'word' => [
                Rule::string(),
            ],
        ], [], [
            'word' => '敏感词',
        ]);
        if ($validator->fails()) {
            return $this->setError($validator->messages());
        }

        if (Str::contains($initDb['word'], ',')) {
            if ($id) {
                return $this->setError('暂不支持批量编辑!');
            }
            $words = explode(',', $initDb['word']);
            foreach ($words as $word) {
                SysSensitiveWord::create(['word' => $word]);
            }
        }

        if ($id && $this->initWord($id)) {
            $this->item->update($initDb);
        }

        return true;
    }

    /**
     * 删除数据
     * @param int $id 敏感词id
     * @return bool|null
     * @throws Exception
     */
    public function delete(int $id): bool
    {
        if ($id && !$this->initWord($id)) {
            return false;
        }

        try {
            SysSensitiveWord::where('id', $id)->delete();

            return true;
        } catch (Exception $e) {
            return $this->setError($e->getMessage());
        }
    }

    /**
     * 初始化id
     * @param int $id 敏感词id
     * @return bool
     */
    public function initWord(int $id): bool
    {
        try {
            $this->item = SysSensitiveWord::find($id);

            return true;
        } catch (Throwable $e) {
            return $this->setError(trans('py-sensitive-word::action.word.item_not_exist'));
        }
    }

}