<?php declare(strict_types = 1);

namespace Darkling\ZomatoClient\Request;

use Dogma\Web\Url;

interface Request
{

	public function getUrl(): Url;

}
