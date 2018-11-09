<?php declare(strict_types = 1);

namespace Darkling\ZomatoClient\Result;

use GuzzleHttp\Psr7\Response;

class ResultFactory
{

	public const OUTPUT_JSON = 'json';
	public const OUTPUT_JSON_RAW = 'json_raw';
	public const OUTPUT_XML = 'xml';
	public const OUTPUT_XML_RAW = 'xml_raw';

	public const OUTPUTS = [
		self::OUTPUT_JSON,
		self::OUTPUT_JSON_RAW,
		self::OUTPUT_XML,
		self::OUTPUT_XML_RAW,
	];

	public function create(string $output, Response $response): Result
	{

		$statusCode = $response->getStatusCode();
		$data = $response->getBody()->getContents();

		if ($statusCode !== 200) {
			return new EmptyResult($statusCode);
		}

		if ($output === self::OUTPUT_JSON) {
			return new JsonResult($statusCode, $data);
		}
	}

}
