<?php declare(strict_types = 1);

namespace Darkling\ZomatoClient\Response;

use Dogma\Enum\IntEnum;

class ResponseOption extends IntEnum
{

	public const JSON_ARRAY = 1;
	public const JSON_STD_CLASS = 2;
	public const JSON_STRING = 3;

}
