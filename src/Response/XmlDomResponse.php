<?php declare(strict_types = 1);

namespace Darkling\ZomatoClient\Response;

use DOMDocument;

class XmlDomResponse extends BaseResponse
{

	public function getData(): DOMDocument
	{
		$xmlDoc = new DOMDocument();
		$xmlDoc->loadXML($this->data);
		return $xmlDoc;
	}

}
