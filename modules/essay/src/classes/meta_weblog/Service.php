<?php

namespace Essay\Classes\MetaWeblog;

class Service
{
	private $xml                = '';

	private $method             = '';//默认发布新文章

	private $url                = '';

	private $charset            = 'utf-8';

	private $username           = '';

	private $passwd             = '';

	private $blog_id            = '1';

	private $metaweblog_message = null;

	private $error              = null;

	private $header             = [
		'Accept'          => '*/*',
		'Accept-Language' => 'zh-CN, en-US, en, *',
		'Content-Type'    => 'text/xml;charset=utf-8',
		'User-Agent'      => 'Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1; Windows Live Writer 1.0)',
	];

	/*
	 MetaWeblog API中文说明
	1、什么是MetaWeblog API？
	MetaWeblog API（MWA）是一个Blog程序接口标准，允许外部程序来获取或者设置Blog的文字和熟悉。他建立在XMLRPC接口之上，并且已经有了很多的实现。
	2、基本的函数规范
	有三个基本的函数规范：
	metaWeblog.newPost (blogid, username, password, struct, publish) 返回一个字符串，可能是Blog的ID。
	metaWeblog.editPost (postid, username, password, struct, publish) 返回一个Boolean值，代表是否修改成功。
	metaWeblog.getPost (postid, username, password) 返回一个Struct。
	其中blogid、username、password分别代表Blog的id（注释：如果你有两个Blog，blogid指定你需要编辑的blog）、用户名和密码。
	 * */
	public function __construct($url, $charset = 'utf-8')
	{
		$this->url     = $url;
		$this->charset = $charset;
	}

	public function setAuth($username, $passwd)
	{
		$this->username = $username;
		$this->passwd   = $passwd;
	}

	public function newPost($params, $is_csdn = false)
	{
		$this->method = 'metaWeblog.newPost';
		if ($is_csdn) {//先这样试试去
			$this->blog_id = 895030;
		}
		$this->buildXML($params);
		$res_xml                  = $this->doPost();
		$this->metaweblog_message = new Message($res_xml);
		if (!$this->metaweblog_message->parse()) {
			$this->error = new Error(-32700, 'parse error. not well formed');

			return false;
		}

		if ($this->metaweblog_message->messageType == 'fault') {
			$this->error = new Error($this->metaweblog_message->faultCode, $this->metaweblog_message->faultString);

			return false;
		}

		return true;
	}

	public function editPost($blog_id, $params)
	{
		$this->blog_id = $blog_id;
		$this->method  = 'metaWeblog.editPost';
		$this->buildXML($params);
		$res_xml                  = $this->doPost();
		$this->metaweblog_message = new Message($res_xml);
		if (!$this->metaweblog_message->parse()) {
			$this->error = new Error(-32700, 'parse error. not well formed');

			return false;
		}

		if ($this->metaweblog_message->messageType == 'fault') {
			$this->error = new Error($this->metaweblog_message->faultCode, $this->metaweblog_message->faultString);

			return false;
		}

		return true;
	}

	private function doPost()
	{
		$this->header['Content-Type'] = 'text/xml;charset=' . $this->charset;
		$header                       = [];
		foreach ($this->header as $_h_key => $_h_val) {
			$header[] = "{$_h_key}: {$_h_val}";
		}

		$ch = curl_init($this->url);
		curl_setopt($ch, CURLOPT_URL, $this->url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
		curl_setopt($ch, CURLOPT_VERBOSE, true);//命令行显示
		//curl_setopt($ch, CURLOPT_HTTPHEADER, array('Expect:'));
		curl_setopt($ch, CURLOPT_ENCODING, $this->charset);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $this->xml);
		$response = curl_exec($ch);
		if (curl_errno($ch)) {
			echo curl_error($ch);

			return false;
		}
		curl_close($ch);

		$log = date('Y-m-d H:i:s') . "  url: {$this->url} \nmethod: {$this->method} \ndata: {$this->xml} \nresult: {$response} \n";
		\Log::debug($log);

		return $response;
	}

	public function getResponse()
	{
		return $this->metaweblog_message->params[0];
	}

	public function isError()
	{
		return is_object($this->error);
	}

	public function getErrorCode()
	{
		return $this->error->code;
	}

	public function getErrorMessage()
	{
		return $this->error->message;
	}

	private function buildXML($params)
	{
		$this->xml = <<<EOD
<?xml version="1.0" encoding="{$this->charset}"?>
<methodCall>
<methodName>{$this->method}</methodName>
<params>
    <param>
        <value>
        <string>{$this->blog_id}</string>
        </value>
    </param>
    <param>
        <value>
        <string>{$this->username}</string>
        </value>
    </param>
    <param>
        <value>
        <string>{$this->passwd}</string>
        </value>
    </param>
EOD;
		$this->xml .= $this->buildBody($params);
		$this->xml .= <<<EOT

    <param>
       <value>
        <boolean>1</boolean>
       </value>
    </param>
EOT;

		$this->xml .= <<<EOT

</params></methodCall>
EOT;
	}

	private function buildBody($params)
	{
		$xml = <<<EOD

    <param>
       <value>
        <struct>
EOD;
		foreach ($params as $_key => $_val) {
			if (is_array($_val)) {
				$xml .= $this->buildMainArr($_key, $_val);
			}
			else {
				$xml .= <<<EOD

            <member>
              <name>{$_key}</name>
              <value>
                <string>{$_val}</string>
              </value>
            </member>
EOD;
			}
		}

		$xml .= <<<EOD

        </struct>
       </value>
    </param>
EOD;

		return $xml;
	}

	private function buildMainArr($name, $data)
	{
		$xml = <<<EOD

            <member>
                <name>{$name}</name>
                <value>
                  <array>
                    <data>
EOD;
		foreach ($data as $_val) {
			$xml .= <<<EOD

                        <value>
                            <string>{$_val}</string>
                        </value>
EOD;
		}

		$xml .= <<<EOD

                     </data>
                   </array>
                  </value>
            </member>
EOD;

		return $xml;
	}
}

