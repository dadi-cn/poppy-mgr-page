<?php

namespace Essay\Action;

use Essay\Models\ArticleContent;
use Essay\Models\ArticleVersion;

class Version
{

	/**
	 * @param $blog ArticleContent 文档内容
	 * @return bool
	 */
	public function create($blog)
	{
		$blogVersionId = $this->nextVersionId($blog->id);
		ArticleVersion::create([
			'content_id' => $blog->id,
			'account_id' => $blog->account_id,
			'version_id' => $blogVersionId,
			'content_md' => $blog->content_md,
		]);

		return true;
	}

	private function nextVersionId($blog_id)
	{
		return ArticleVersion::where('blog_id', $blog_id)->max('blog_version_id') + 1;
	}
}