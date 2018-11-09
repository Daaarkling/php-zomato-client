<?php declare(strict_types = 1);

namespace Darkling\ZomatoClient\Request\Type;

use Dogma\Web\Url;

interface RequestType
{

	public function getUrl(): Url;

}
