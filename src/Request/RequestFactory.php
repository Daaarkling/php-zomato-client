<?php declare(strict_types = 1);

namespace Darkling\ZomatoClient\Request;

use Darkling\ZomatoClient\Request\Type\RequestType;
use Darkling\ZomatoClient\Request\Type\RequestTypes;

class RequestFactory
{

	public function create(RequestTypes $requestTypes, array $params, $output): Request
	{
		/** @var RequestType $requestType */
		$requestType = new $requestTypes->getValue()($params);
		return new Request($requestType);
	}

}
