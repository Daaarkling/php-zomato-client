<?php declare(strict_types = 1);

namespace Darkling\ZomatoClient\Request\Enum;

use Dogma\Enum\StringEnum;

class EntityType extends StringEnum
{

	public const CITY = 'city';
	public const SUB_ZONE = 'subzone';
	public const ZONE = 'zone';
	public const LANDMARK = 'landmark';
	public const METRO = 'metro';
	public const GROUP = 'group';

}
