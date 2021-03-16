<?php

namespace Url\Models\Filters;

use EloquentFilter\ModelFilter;

class UrlCollectionFilter extends ModelFilter
{
	public function kw($kw)
	{
		return $this->whereLike('title', $kw);
	}
}
