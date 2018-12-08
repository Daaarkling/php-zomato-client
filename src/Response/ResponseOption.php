<?php declare(strict_types = 1);

namespace Darkling\ZomatoClient\Response;

use Dogma\Enum\IntEnum;

class ResponseOption extends IntEnum
{

	public const JSON_ARRAY = 1;
	public const JSON_STD_CLASS = 2;
	public const JSON_STRING = 3;
	public const XML_SIMPLE_XML = 4;
	public const XML_DOM = 5;
	public const XML_STRING = 6;

	public function isJsonRequest(): bool
	{
		return $this->equals(self::JSON_ARRAY)
			|| $this->equals(self::JSON_STD_CLASS)
			|| $this->equals(self::JSON_STRING);
	}

	public function isXmlRequest(): bool
	{
		return $this->equals(self::XML_SIMPLE_XML)
			|| $this->equals(self::XML_DOM)
			|| $this->equals(self::XML_STRING);
	}

}
