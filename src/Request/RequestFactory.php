<?php declare(strict_types = 1);

namespace Darkling\ZomatoClient\Request;

class RequestFactory
{

	public function create(RequestType $requestType, array $params): Request
	{
		/** @var RequestType $requestType */
		$requestType = new $requestType->getValue()($params);
		return new Request($requestType);
	}

}
