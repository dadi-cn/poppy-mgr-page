<?php namespace Poppy\Framework\Application;

use Carbon\Carbon;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Poppy\Framework\Helper\EnvHelper;
use Route;
use View;

/**
 * poppy controller
 */
abstract class Controller extends BaseController
{
	use DispatchesJobs, ValidatesRequests;

	/**
	 * @var string 权限(中间件中可以读取, 使用 public 模式)
	 */
	public static $permission;

	/**
	 * pagesize
	 * @var int $pagesize
	 */
	protected $pagesize = 15;

	/**
	 * ip
	 * @var string $ip
	 */
	protected $ip;

	/**
	 * now
	 * @var Carbon $now
	 */
	protected $now;

	/**
	 * route
	 * @var string $route
	 */
	protected $route;

	/**
	 * title
	 * @var string $title
	 */
	protected $title;

	/**
	 * Controller constructor.
	 */
	public function __construct()
	{
		$this->route = Route::currentRouteName();
		View::share([
			'_route' => $this->route,
		]);

		// pagesize
		$this->pagesize = config('poppy.framework.page_size', 15);
		$maxPagesize    = config('poppy.framework.page_max');
		if (input('pagesize')) {
			$pagesize = abs((int) input('pagesize'));
			$pagesize = ($pagesize <= $maxPagesize) ? $pagesize : $maxPagesize;
			if ($pagesize > 0) {
				$this->pagesize = $pagesize;
			}
		}

		$this->ip  = EnvHelper::ip();
		$this->now = Carbon::now();

		View::share([
			'_ip'       => $this->ip,
			'_now'      => $this->now,
			'_pagesize' => $this->pagesize,
		]);

		// 自动计算seo
		// 根据路由名称来转换 seo key
		// slt:nav.index  => slt::seo.nav_index
		$seoKey = str_replace([':', '.'], ['::', '_'], $this->route);
		if ($seoKey) {
			$seoKey = str_replace('::', '::seo.', $seoKey);
			$this->seo(trans($seoKey));
		}
	}

	/**
	 * seo
	 * @param mixed ...$args args
	 */
	protected function seo(...$args)
	{
		[$title, $description] = parse_seo($args);

		$title       = $title ? $title . '-' . config('poppy.framework.title') : config('poppy.framework.title');
		$description = $description ?: config('poppy.framework.description');

		$this->title = $title;
		View::share([
			'_title'       => $title,
			'_description' => $description,
		]);
	}
}