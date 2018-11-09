<?php declare(strict_types = 1);

namespace Darkling\ZomatoClient;

use Darkling\ZomatoClient\Result\Result;
use Darkling\ZomatoClient\Result\ResultFactory;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Response;
use Nette\Http\Url;
use Nette\Utils\Json;
use stdClass;

class ZomatoClient
{

	/** @var \GuzzleHttp\Client */
	private $httpClient;

	public function __construct(string $userKey, string $output = OutputOption::JSON, ?Client $guzzleClient = null)
	{
		if (!OutputOption::isValid($output)) {
			throw new InvalidOutputOptionException($output);
		}

		if ($guzzleClient === null) {
			$this->httpClient = new Client();
		}
		$this->httpClient->co
		$this->httpClient = new Client([
			'headers' => [
				'user_key' => $userKey,
			],
		]);

		$this->output = $output;
		$this->resultFactory = new ResultFactory();
	}

	private function send(Request $request): Response
	{
		try {

			return $this->httpClient->request($url);

		} catch (GuzzleException $e) {
			throw new ZomatoRequestException($url->getAbsoluteUrl(), $e);
		}
	}

	private function sendAsync(Request $request): Response
	{
		try {
			$url = new Url(self::URL_BASE . $endpoint);
			$url->appendQuery($params);

			return $this->httpClient->request($url);

		} catch (GuzzleException $e) {
			throw new ZomatoRequestException($url->getAbsoluteUrl(), $e);
		}
	}

}
