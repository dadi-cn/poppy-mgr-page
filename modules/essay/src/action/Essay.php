<?php namespace Essay\Action;

use Essay\Models\EssayContent;
use Poppy\Framework\Classes\Traits\AppTrait;
use Poppy\Framework\Validation\Rule;
use Poppy\System\Classes\Traits\PamTrait;

/**
 * 广告内容处理类
 */
class Essay
{
	use AppTrait, PamTrait;

	/**
	 * @var EssayContent $essayContent
	 */
	private $essayContent;

	/**
	 * @var int $id
	 */
	private $id;

	/**
	 * @var string
	 */
	protected $essayTable;

	public function __construct()
	{
		$this->essayTable = (new EssayContent())->getTable();
	}

	/**
	 * 编辑/创建 文章
	 * @param array $data 传入数据
	 *                    string  title       标题
	 *                    string  description 描述
	 *                    string  author      作者
	 *                    string  content     内容
	 * @param null  $id   文章ID
	 * @return bool
	 */
	public function establish($data, $id = null): bool
	{
		if (!$this->checkPam()) {
			return false;
		}
		$initDb = [
			'title'       => (string) sys_get($data, 'title'),
			'description' => (string) sys_get($data, 'description'),
			'author'      => (string) sys_get($data, 'author'),
			'content'     => (string) sys_get($data, 'content'),
		];

		$validator = \Validator::make($initDb, [
			'title'       => [
				Rule::required(),
				Rule::string(),
				Rule::max(30),
				Rule::unique($this->essayTable, 'title')->where(function ($query) use ($id) {
					if ($id) {
						$query->where('id', '!=', $id);
					}
				}),

			],
			'description' => [
				Rule::required(),
				Rule::max(30),
				Rule::string(),
			],
			'author'      => [
				Rule::required(),
				Rule::max(10),
				Rule::string(),
			],
			'content'     => [
				Rule::required(),
				Rule::string(),
			],
		], [], [
			'title'       => '标题',
			'description' => '描述',
			'author'      => '作者',
			'content'     => '内容',
		]);

		if ($validator->fails()) {
			return $this->setError($validator->errors());
		}

		// init
		if ($id && !$this->init($id)) {
			return false;
		}

		if ($id) {
			$this->essayContent->update($initDb);
		}
		else {
			/** @var EssayContent $essayContent */
			$essayContent       = EssayContent::create($initDb);
			$this->essayContent = $essayContent;
		}

		return true;
	}

	/**
	 * 删除数据
	 * @param int $id 活动ID
	 * @return bool
	 */
	public function delete($id): bool
	{
		if (!$this->checkPam()) {
			return false;
		}
		if ($id && !$this->init($id)) {
			return false;
		}

		try {
			$this->essayContent->delete();
		} catch (\Exception $e) {
			return $this->setError($e->getMessage());
		}

		return true;
	}

	/**
	 * 初始化
	 * @param int $id 活动 ID
	 * @return bool
	 */
	public function init($id)
	{
		try {
			$this->essayContent = EssayContent::findOrFail($id);
			$this->id           = $this->essayContent->id;

			return true;
		} catch (\Exception $e) {
			return $this->setError('ID 不合法, 不存在此数据');
		}
	}
}