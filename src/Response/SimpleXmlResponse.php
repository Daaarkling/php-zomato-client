<?php declare(strict_types = 1);

namespace Darkling\ZomatoClient\Response;

use SimpleXMLElement;

class SimpleXmlResponse extends BaseResponse
{

	public function getData(): SimpleXMLElement
	{
		return new SimpleXMLElement($this->data);
	}

}
