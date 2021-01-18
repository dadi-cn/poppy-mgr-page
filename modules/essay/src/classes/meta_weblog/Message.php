<?php namespace Essay\Classes\MetaWeblog;

class Message
{
	public $message;

	public $messageType;
  // methodCall / methodResponse / fault
	public $faultCode;

	public $faultString;

	public $methodName;

	public $params;

	// Current variable stacks
	public $_arraystructs      = [];
   // The stack used to keep track of the current array/struct
	public $_arraystructstypes = [];
 // Stack keeping track of if things are structs or array
	public $_currentStructName = [];
  // A stack as well
	public $_param;

	public $_value;

	public $_currentTag;

	public $_currentTagContents;

	// The XML parser
	public $_parser;

	public function __construct($message)
	{
		$this->message = $message;
	}

	public function parse()
	{
		$header        = preg_replace('/<\?xml.*?\?' . '>/', '', substr($this->message, 0, 100), 1);
		$this->message = substr_replace($this->message, $header, 0, 100);
		if (trim($this->message) == '') {
			return false;
		}
		$this->_parser = xml_parser_create();
		xml_parser_set_option($this->_parser, XML_OPTION_CASE_FOLDING, false);
		xml_set_object($this->_parser, $this);
		xml_set_element_handler($this->_parser, 'tag_open', 'tag_close');
		xml_set_character_data_handler($this->_parser, 'cdata');
		$chunk_size = 262144; // 256Kb, parse in chunks to avoid the RAM usage on very large messages
		$final      = false;
		do {
			if (strlen($this->message) <= $chunk_size) {
				$final = true;
			}
			$part          = substr($this->message, 0, $chunk_size);
			$this->message = substr($this->message, $chunk_size);
			if (!xml_parse($this->_parser, $part, $final)) {
				return false;
			}
			if ($final) {
				break;
			}
		} while (true);
		xml_parser_free($this->_parser);
		if ($this->messageType == 'fault') {
			$this->faultCode   = $this->params[0]['faultCode'];
			$this->faultString = $this->params[0]['faultString'];
		}

		return true;
	}

	public function tag_open($parser, $tag, $attr)
	{
		$this->_currentTagContents = '';
		$this->currentTag          = $tag;
		switch ($tag) {
			case 'methodCall':
			case 'methodResponse':
			case 'fault':
				$this->messageType = $tag;
				break;
			/* Deal with stacks of arrays and structs */
			case 'data':    // data is to all intents and puposes more interesting than array
				$this->_arraystructstypes[] = 'array';
				$this->_arraystructs[]      = [];
				break;
			case 'struct':
				$this->_arraystructstypes[] = 'struct';
				$this->_arraystructs[]      = [];
				break;
		}
	}

	public function cdata($parser, $cdata)
	{
		$this->_currentTagContents .= $cdata;
	}

	public function tag_close($parser, $tag)
	{
		$valueFlag = false;
		switch ($tag) {
			case 'int':
			case 'i4':
				$value     = (int) trim($this->_currentTagContents);
				$valueFlag = true;
				break;
			case 'double':
				$value     = (float) trim($this->_currentTagContents);
				$valueFlag = true;
				break;
			case 'string':
				$value     = (string) trim($this->_currentTagContents);
				$valueFlag = true;
				break;
			case 'dateTime.iso8601':
				$value     = new IXR_Date(trim($this->_currentTagContents));
				$valueFlag = true;
				break;
			case 'value':
				// "If no type is indicated, the type is string."
				if (trim($this->_currentTagContents) != '') {
					$value     = (string) $this->_currentTagContents;
					$valueFlag = true;
				}
				break;
			case 'boolean':
				$value     = (bool) trim($this->_currentTagContents);
				$valueFlag = true;
				break;
			case 'base64':
				$value     = base64_decode($this->_currentTagContents);
				$valueFlag = true;
				break;
			/* Deal with stacks of arrays and structs */
			case 'data':
			case 'struct':
				$value = array_pop($this->_arraystructs);
				array_pop($this->_arraystructstypes);
				$valueFlag = true;
				break;
			case 'member':
				array_pop($this->_currentStructName);
				break;
			case 'name':
				$this->_currentStructName[] = trim($this->_currentTagContents);
				break;
			case 'methodName':
				$this->methodName = trim($this->_currentTagContents);
				break;
		}

		if ($valueFlag) {
			if (count($this->_arraystructs) > 0) {
				// Add value to struct or array
				if ($this->_arraystructstypes[count($this->_arraystructstypes) - 1] == 'struct') {
					// Add to struct
					$this->_arraystructs[count($this->_arraystructs) - 1][$this->_currentStructName[count($this->_currentStructName) - 1]] = $value;
				}
				else {
					// Add to array
					$this->_arraystructs[count($this->_arraystructs) - 1][] = $value;
				}
			}
			else {
				// Just add as a paramater
				$this->params[] = $value;
			}
		}
		$this->_currentTagContents = '';
	}
}