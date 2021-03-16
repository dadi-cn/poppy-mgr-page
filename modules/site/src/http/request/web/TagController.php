<?php

namespace Site\Http\Request\Web;

use DB;
use Poppy\Framework\Application\Controller;
use Site\Models\SiteTag;

class TagController extends Controller
{
	/**
	 * @return void
	 */
	public function search()
	{
		$kw        = trim(input('search'));
		$tbSiteTag = (new SiteTag())->getTable();

		$tags = DB::table($tbSiteTag)
			->select([$tbSiteTag . '.title', $tbSiteTag . '.id'])
			->distinct()
			->where(function ($query) use ($kw, $tbSiteTag) {
				if ($kw) {
					$query->where(function ($q) use ($kw, $tbSiteTag) {
						$q->orWhere($tbSiteTag . '.title', 'like', '%' . $kw . '%');
						$q->orWhere($tbSiteTag . '.spell', 'like', '%' . $kw . '%');
						$q->orWhere($tbSiteTag . '.first_letter', 'like', '%' . $kw . '%');
					});
				}
			})
			->get();

		// dd($tags);
		$data = [];
		if ($tags->count()) {
			foreach ($tags as $tag) {
				$data[] = [
					'title'  => $tag->title,
					'tag_id' => $tag->id,
				];
			}
		}

		$return = [];
		if (count($data)) {
			foreach ($data as $tag) {
				$return[] = [
					'value' => $tag['title'],
					'text'  => $tag['title'],
				];
			}
		}
		echo json_encode($return);
	}
}