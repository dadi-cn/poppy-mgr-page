<?php namespace Essay\Classes\MetaWeblog;

class Value
{
	public $data;

	public $type;

	public function __construct($data, $type = false)
	{
	}

	public function getXml()
	{
		// Return XML for this value
		switch ($this->type) {
			case 'boolean':
				return '<boolean>' . (($this->data) ? '1' : '0') . '</boolean>';
				break;
			case 'int':
				return '<int>' . $this->data . '</int>';
				break;
			case 'double':
				return '<double>' . $this->data . '</double>';
				break;
			case 'string':
				return '<string>' . htmlspecialchars($this->data) . '</string>';
				break;
			case 'array':
				$return = '<array><data>' . "\n";
				foreach ($this->data as $item) {
					$return .= '  <value>' . $item->getXml() . "</value>\n";
				}
				$return .= '</data></array>';

				return $return;
				break;
			case 'struct':
				$return = '<struct>' . "\n";
				foreach ($this->data as $name => $value) {
					$name   = htmlspecialchars($name);
					$return .= "  <member><name>$name</name><value>";
					$return .= $value->getXml() . "</value></member>\n";
				}
				$return .= '</struct>';

				return $return;
				break;
			case 'date':
			case 'base64':
				return $this->data->getXml();
				break;
		}

		return false;
	}
}