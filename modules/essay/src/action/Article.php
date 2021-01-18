<?php namespace Essay\Action;

use Essay\Models\ArticleBook;
use Essay\Models\ArticleContent;
use Poppy\Framework\Classes\Traits\AppTrait;
use Poppy\Framework\Validation\Rule;
use Site\Models\SiteTag;
use Poppy\System\Classes\Traits\PamTrait;
use Throwable;
use Validator;

class Article
{
	use AppTrait, PamTrait;

	/** @type  ArticleContent */
	private $article;

	/** @var ArticleBook */
	private $book;

	private $prdTable;

	public function __construct()
	{
		$this->prdTable = (new ArticleContent())->getTable();
	}

	public function establish($data, $id = null)
	{
		if (!$this->checkPam()) {
			return false;
		}
		\Log::debug($data);
		exit;
		$tags = array_get($data, 'tags');
		if (is_string($tags)) {
			$tagNote = trim($tags);
		} else {
			$tagNote = $tags ? implode(',', $tags) : '';
		}

		$createdAt = data_get($data, 'created_at');

		$initDb    = [
			'title'       => array_get($data, 'title'),
			'symbol_link' => array_get($data, 'flag'),
			'book_id'     => array_get($data, 'book_id'),
			'content'     => array_get($data, 'content'),
			'tag_note'    => $tagNote,
			'account_id'  => $this->pam->id,
		];
		$validator = Validator::make($initDb, [
			'book_id' => [
				Rule::required(),
				Rule::numeric(),
			],
			'content' => [
				Rule::required(),
			],
		], [], [
			'content' => '文档内容',
			'book_id' => '文库',
		]);
		if ($validator->fails()) {
			return $this->setError($validator->errors());
		}

		if ($id) {
			if (!$this->init($id)) {
				return false;
			}
			if (!$this->pam->can('edit', [$this->article])) {
				return $this->setError('此文档不是您创建, 您无权操作');
			}
			$oldContent = $this->article->content;
			$this->article->update($initDb);
			$this->article->created_at = $createdAt;
			$this->article->save();
		}
		else {
			$oldContent    = '';
			$this->article = ArticleContent::create($initDb);
			// update created
			$this->article->created_at = $createdAt;
			$this->article->save();
			// $this->prd->top_parent_id = ArticleContent::topParentId($this->prd->id);
			// $this->prd->save();
		}

		// 处理标签关联
		// $Tag = new ActPrdTag();
		// $Tag->handle($this->article);

		// 版本创建
		if (md5($oldContent) != md5($this->article->content_origin)) {
			// $Version = new ActPrdVersion();
			// $Version->create($this->article);
		}

		return true;
	}

	/**
	 * 销毁文章
	 * @param int $id ID
	 * @return bool
	 */
	public function destroy($id): bool
	{
		if (!$this->checkPam()) {
			return false;
		}
		if (!$this->init($id)) {
			return false;
		}
		if (!$this->pam->can('destroy', [$this->article])) {
			return $this->setError('不是所有者, 无权删除');
		}

		try {
			$this->article->delete();
			return true;
		} catch (Throwable $e) {
			return $this->setError($e);
		}

	}

	/**
	 * 标题创建
	 * @param array $data
	 * @param null  $id
	 * @return bool
	 */
	public function establishPopup(array $data, $id = null)
	{
		// login check
		if (!$this->checkPam()) {
			return false;
		}

		// rule check
		$book_id   = intval(array_get($data, 'book_id'));
		$rule      = [
			'book_id' => 'required',
			'title'   => [
				'required',
				Rule::unique($this->prdTable, 'title')->where(function ($query) use ($id, $book_id) {
					$query->where('account_id', $this->pam->id);
					if ($id) {
						$query->where('id', '!=', $id);
					}
					if ($book_id) {
						$query->where('book_id', $id);
					}
				}),
			],
		];
		$validator = Validator::make($data, $rule, [], [
			'title'   => '文档标题',
			'book_id' => '文库',
		]);
		if ($validator->fails()) {
			return $this->setError($validator->errors());
		}

		// db handle
		// init
		$data = [
			'title'      => strval(array_get($data, 'title')),
			'account_id' => $this->pam->id,
			'book_id'    => $book_id,
			'parent_id'  => intval(array_get($data, 'parent_id')),
		];

		if ($id) {
			// edit
			if (!$this->init($id)) {
				return false;
			}
			if (!$this->pam->can('edit', [$this->article])) {
				return $this->setError('您无权操作');
			}
			$this->article->update($data);
		}
		else {
			$data = array_merge($data, [
				'good_num'       => 0,
				'bad_num'        => 0,
				'password'       => '',
				'description'    => '',
				'content_origin' => '',
				'author'         => '',
				'icon'           => '',
				'list_order'     => 0,
				'hits'           => 0,
				'is_star'        => 0,
				'tag_note'       => '',
			]);

			// db create
			$this->article = ArticleContent::create($data);
		}

		return true;
	}

	/**
	 * 标题创建
	 * @param array $data
	 * @param null  $id
	 * @return bool
	 */
	public function establishBook(array $data, $id = null)
	{
		// login check
		if (!$this->checkPam()) {
			return false;
		}

		// rule check
		$rule      = [
			'title' => [
				'required',
				Rule::unique($this->prdTable, 'title')->where(function ($query) use ($id) {
					$query->where('account_id', $this->pam->id);
					if ($id) {
						$query->where('id', '!=', $id);
					}
				}),
			],
		];
		$validator = Validator::make($data, $rule, [], [
			'title' => '文库',
		]);
		if ($validator->fails()) {
			return $this->setError($validator->errors());
		}

		// db handle
		// init
		$data = [
			'title'      => strval(array_get($data, 'title')),
			'account_id' => $this->pam->id,
		];

		if ($id) {
			// edit
			if (!$this->initBook($id)) {
				return false;
			}
			if (!$this->policy('self', [$this->book], '此文库不是您创建, 您无权操作')) {
				return false;
			}
			$this->book->update($data);
		}
		else {
			$data = array_merge($data, [
				'account_id' => $this->pam->id,
				'is_favor'   => 0,
			]);

			// db create
			$this->book = ArticleBook::create($data);
		}

		return true;
	}

	/**
	 * 初始化条目信息
	 * @param $id
	 * @return bool
	 */
	public function init($id)
	{
		if (!ArticleContent::where('id', $id)->exists()) {
			return $this->setError('此条目不存在!');
		}
		$this->article = ArticleContent::find($id);

		return true;
	}

	/**
	 * 初始化条目信息
	 * @param $id
	 * @return bool
	 */
	public function initBook($id)
	{
		if (!ArticleBook::where('id', $id)->exists()) {
			return $this->setError('此条目不存在!');
		}
		$this->book = ArticleBook::find($id);

		return true;
	}

	public function data($data)
	{
		if (isset($data['prd_tag']) && $data['prd_tag']) {
			$data['prd_tag'] = SiteTag::encode($data['prd_tag']);
		}
		if (isset($data['_token'])) {
			unset($data['_token']);
		}
		if (!isset($data['prd_content'])) {
			$data['prd_content'] = '';
		}
		if ($this->pam) {
			$data['account_id'] = $this->pam->id;
		}

		return $data;
	}

	public function getArticle()
	{
		return $this->article;
	}

	public function getBook()
	{
		return $this->book;
	}
}