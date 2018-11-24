<?php declare(strict_types = 1);

namespace Darkling\ZomatoClient;

use Darkling\ZomatoClient\Response\OptionResponseFactory;
use Darkling\ZomatoClient\Response\ResponseOption;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\CurlHandler;
use GuzzleHttp\HandlerStack;

class GuzzleZomatoClientFactory implements ZomatoClientFactory
{

	public function create(string $userKey, ?ResponseOption $responseOption = null): ZomatoClient
	{
		$stack = new HandlerStack();
		$stack->setHandler(new CurlHandler());

		$httpClient = new Client([
			'handler' => $stack,
		]);

		return new ZomatoClient(
			$userKey,
			$responseOption ?? ResponseOption::get(ResponseOption::JSON_STRING),
			new OptionResponseFactory(),
			$httpClient
		);
	}

}
