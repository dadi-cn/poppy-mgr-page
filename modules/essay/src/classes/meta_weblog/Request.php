<?php namespace Essay\Classes\MetaWeblog;

class Request
{
	private $xml       = '';

	private $charset   = 'utf-8';

	private $method    = '';

	private $blog_id   = '1';

	private $username  = '';

	private $passwd    = '';

	private $post_data = [];

	/**
	 * params = [
	 *      'charset' => 'utf-8',
	 *      'method' =>  metaWeblog.newPost/metaWeblog.editPost/metaWeblog.getPost,
	 *      'blog_id' => '1',
	 *      'username' => 'xxxx',
	 *      'passwd' => 'xxxxx',
	 *      'post_data' => [
	 *          'title' => '',
	 *          'description' => '',
	 *          'categories' => []
	 *      ]
	 * ];
	 */
	public function __construct($params)
	{
		$this->charset   = $params['charset'];
		$this->method    = $params['method'];
		$this->blog_id   = $params['blog_id'];
		$this->username  = $params['username'];
		$this->passwd    = $params['passwd'];
		$this->post_data = $params['post_data'];
		$this->buildXML($this->post_data);
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

	public function getLength()
	{
		return strlen($this->xml);
	}

	public function getXml()
	{
		return $this->xml;
	}
}