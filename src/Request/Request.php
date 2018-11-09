<?php declare(strict_types = 1);

namespace Darkling\ZomatoClient\Request;

use Darkling\ZomatoClient\Request\Type\RequestType;

class Request
{

	public const URL_BASE = 'https://developers.zomato.com/api/v2.1/';

	/** @var RequestType */
	private $requestType;

	public function __construct(RequestType $requestType)
	{
		$this->requestType = $requestType;
	}
	
	

}
