<?php declare(strict_types = 1);

namespace Darkling\ZomatoClient\Request\Enum;

use Dogma\Enum\StringEnum;

class Sort extends StringEnum
{

	public const COST = 'cost';
	public const RATING = 'rating';
	public const REAL_DISTANCE = 'real_distance';

}
