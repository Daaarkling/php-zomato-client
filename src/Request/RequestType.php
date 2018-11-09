<?php declare(strict_types = 1);

namespace Darkling\ZomatoClient\Request;

use Dogma\Enum\StringEnum;

class RequestType extends StringEnum
{

	public const DAILY_MENU = DailyMenuRequest::class;

}
