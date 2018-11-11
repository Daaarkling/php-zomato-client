<?php declare(strict_types = 1);

namespace Darkling\ZomatoClient;

use Darkling\ZomatoClient\Request\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Response;
use Nette\Http\Url;

class ZomatoClient
{

	public const BASE_API_URL = '';

	/** @var string */
	private $userKey;

	/** @var string */
	private $output;

	/** @var Client|null */
	private $httpClient;

	public function __construct(string $userKey, string $output = OutputOption::JSON, ?Client $httpClient = null)
	{
		if ($httpClient === null) {
			$httpClient = new Client();
		}

		$this->userKey = $userKey;
		$this->output = $output;
		$this->httpClient = $httpClient;
	}

	public function send(Request $request): Response
	{
		$url = $this->assembleUrl($request->getEndPoint(), $request->getParameters());
		try {
			return $this->httpClient->request($url->getAbsoluteUrl());

		} catch (GuzzleException $e) {
			throw new ZomatoRequestException($url->getAbsoluteUrl(), $e);
		}
	}

	public function sendAsync(Request $request, callable $onSuccess, callable $onFail): void
	{
		$url = $this->assembleUrl($request->getEndPoint(), $request->getParameters());
		try {
			$this->httpClient->requestAsync($url->getAbsoluteUrl()).then(
				function (Response $guzzleResponse) use ($onSuccess) {
					$response = 'balbalba';
					$onSuccess($response);
				},
				function () use ($onFail) {
					$onFail();
				});

		} catch (GuzzleException $e) {
			throw new ZomatoRequestException($url->getAbsoluteUrl(), $e);
		}
	}

	private function assembleUrl(string $endPoint, array $parameters): Url
	{
		$url = new Url(self::BASE_API_URL . $endPoint);
		$url->appendQuery($parameters);
		return $url;
	}

}
