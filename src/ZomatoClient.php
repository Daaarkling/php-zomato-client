<?php declare(strict_types = 1);

namespace Darkling\ZomatoClient;

use Darkling\ZomatoClient\Request\Request;
use Darkling\ZomatoClient\Response\OptionResponseFactory;
use Darkling\ZomatoClient\Response\Response;
use Darkling\ZomatoClient\Response\ResponseOption;
use Dogma\Http\HttpMethod;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;
use Psr\Http\Message\ResponseInterface;

class ZomatoClient
{

	public const BASE_API_URL = 'https://developers.zomato.com/api/v2.1/';

	/** @var \GuzzleHttp\Client */
	private $httpClient;

	/** @var \Darkling\ZomatoClient\Response\ResponseOption */
	private $defaultResponseOption;

	/** @var \Darkling\ZomatoClient\Response\ResponseFactory */
	private $responseFactory;

	/** @var \Darkling\ZomatoClient\UrlProvider */
	private $urlProvider;

	public function __construct(string $userKey, ?ResponseOption $responseOption = null)
	{
		$this->httpClient = new Client([
			'headers' => [
				'user_key' => $userKey,
			],
		]);
		$this->defaultResponseOption = $responseOption ?? ResponseOption::get(ResponseOption::JSON_STRING);
		$this->responseFactory = new OptionResponseFactory();
		$this->urlProvider = new UrlProvider(self::BASE_API_URL);
	}

	public function send(Request $request, ?ResponseOption $responseOption = null): Response
	{
		$url = $this->urlProvider->getUrl($request);
		$responseOption = $responseOption ?? $this->defaultResponseOption;

		try {
			$httpResponse = $this->httpClient->request(HttpMethod::GET, $url->getAbsoluteUrl());
			return $this->responseFactory->create($responseOption, $httpResponse);

		} catch (GuzzleException $e) {
			throw new ZomatoRequestException($url->getAbsoluteUrl(), $e);
		}
	}

	public function sendAsync(Request $request, callable $onSuccess, callable $onFail, ?ResponseOption $responseOption = null): void
	{
		$responseOption = $responseOption ?? $this->defaultResponseOption;
		$url = $this->urlProvider->getUrl($request);

		$this->httpClient->requestAsync(HttpMethod::GET, $url->getAbsoluteUrl())
			->then(
				function (ResponseInterface $httpResponse) use ($onSuccess, $responseOption): void {
					$onSuccess($this->responseFactory->create($responseOption, $httpResponse));
				},
				static function (RequestException $e) use ($onFail, $url): void {
					$onFail(new ZomatoRequestException($url->getAbsoluteUrl(), $e));
				}
			);
	}

}
