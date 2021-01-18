<?php namespace Php\Http\Request\Web;

use Poppy\System\Http\Request\Web\WebController;

class OutputControlController extends WebController
{
	/**
	 * @url http://yanue.net/post-57.html
	 */
	public function obFlush()
	{
		//实时显示输出
		ob_end_flush(); //关闭php缓存，或者在flush前ob_flush();
		echo str_repeat(' ', 1024); //ie下 需要先发送256个字节, firefox 1024, chrome 2048
		set_time_limit(0);
		for ($i = 0; $i < 10; $i++) {
			echo 'Now Index is :' . $i . '<br>';
			//ob_flush(); //把php缓存推送到apache去，前面已经关闭了php缓存了，这里再推就报错了
			flush(); //把apache缓存推送到浏览器去
			sleep(1);
		}
	}
}