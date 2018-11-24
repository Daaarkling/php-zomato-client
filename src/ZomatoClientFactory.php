<?php declare(strict_types = 1);

namespace Darkling\ZomatoClient;

use Darkling\ZomatoClient\Response\ResponseOption;

interface ZomatoClientFactory
{

	public function create(string $userKey, ?ResponseOption $responseOption = null): ZomatoClient;

}
