<?php declare(strict_types = 1);

namespace Darkling\ZomatoClient;

use Darkling\ZomatoClient\Request\Request;
use Darkling\ZomatoClient\Response\Response;
use Darkling\ZomatoClient\Response\ResponseFactory;
use Darkling\ZomatoClient\Response\ResponseOption;
use Dogma\Http\HttpHeader;
use Dogma\Http\HttpMethod;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;
use Nette\Http\Url;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class ZomatoClient
{

	public const BASE_API_URL = 'https://developers.zomato.com/api/v2.1/';
	private const MIDDLEWARE_NAME = 'content-type';

	/** @var string */
	private $userKey;

	/** @var \GuzzleHttp\Client */
	private $httpClient;

	/** @var \Darkling\ZomatoClient\Response\ResponseOption */
	private $defaultResponseOption;

	/** @var \Darkling\ZomatoClient\Response\ResponseFactory */
	private $responseFactory;

	public function __construct(
		string $userKey,
		ResponseOption $responseOption,
		ResponseFactory $responseFactory,
		Client $httpClient
	)
	{
		$this->userKey = $userKey;
		$this->defaultResponseOption = $responseOption;
		$this->responseFactory = $responseFactory;
		$this->httpClient = $httpClient;
	}

	public function send(Request $request, ?ResponseOption $responseOption = null): Response
	{
		$url = $this->assembleUrl($request);
		$responseOption = $responseOption ?? $this->defaultResponseOption;
		$this->handleContentTypeHeader($responseOption);

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
		$url = $this->assembleUrl($request);
		$this->handleContentTypeHeader($responseOption);

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

	private function assembleUrl(Request $request): Url
	{
		$url = new Url(self::BASE_API_URL . $request->getEndPoint());
		$url->appendQuery(['user_key' => $this->userKey]);
		$url->appendQuery($url->getAbsoluteUrl());
		return $url;
	}

	private function handleContentTypeHeader(ResponseOption $responseOption): callable
	{
		$contentType = $responseOption->isJsonRequest()
			? 'application/json'
			: 'application/xml';

		/** @var \GuzzleHttp\HandlerStack $stack */
		$stack = $this->httpClient->getConfig(['handler']);
		$stack->remove(self::MIDDLEWARE_NAME);
		$stack->push(static function (callable $handler) use ($contentType): callable {
			return static function (RequestInterface $request, array $options) use ($handler, $contentType) {
				$request = $request->withHeader(HttpHeader::CONTENT_TYPE, $contentType);

				return $handler($request, $options);
			};
		}, self::MIDDLEWARE_NAME);
	}

}
