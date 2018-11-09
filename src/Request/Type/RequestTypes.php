<?php declare(strict_types = 1);

namespace Darkling\ZomatoClient\Request\Type;

use Dogma\Enum\StringEnum;

class RequestTypes extends StringEnum
{

	public const DAILY_MENU = DailyMenu::class;

}
