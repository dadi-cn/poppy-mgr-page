<?php

namespace Essay\Action;

use Essay\Models\ArticleBook;
use Essay\Models\ArticleContent;
use Illuminate\Validation\Rule;
use Poppy\Framework\Classes\Traits\AppTrait;
use Poppy\System\Classes\Traits\PamTrait;


class Book
{
	use AppTrait, PamTrait;

	/**
	 * @type  ArticleContent
	 */
	private $article;

	/**
	 * @var ArticleBook
	 */
	private $book;


	private $bookTable;


	public function __construct()
	{
		$this->bookTable = (new ArticleBook())->getTable();
	}

	/**
	 * 标题创建
	 * @param array $data
	 * @param null  $id
	 * @return bool
	 */
	public function establish(array $data, $id = null)
	{
		// login check
		if (!$this->checkPam()) {
			return false;
		}

		// rule check
		$rule      = [
			'title' => [
				'required',
				Rule::unique($this->bookTable, 'title')->where(function ($query) use ($id) {
					$query->where('account_id', $this->pam->id);
					if ($id) {
						$query->where('id', '!=', $id);
					}
				}),
			],
		];
		$validator = \Validator::make($data, $rule, [], [
			'title' => '文库',
		]);
		if ($validator->fails()) {
			return $this->setError($validator->errors());
		}

		// db handle
		// init
		$data = [
			'title'      => (string) sys_get($data, 'title'),
			'account_id' => $this->pam->id,
		];

		if ($id) {
			// edit
			if (!$this->init($id)) {
				return false;
			}
			if (!$this->pam->can('edit', [$this->book])) {
				return $this->setError('此文库不是您创建, 您无权操作');
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