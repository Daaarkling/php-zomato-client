<?php declare(strict_types = 1);

namespace Darkling\ZomatoClient\Response;

use Psr\Http\Message\ResponseInterface;

class OptionResponseFactory implements ResponseFactory
{

	public function create(ResponseOption $responseOption, ResponseInterface $response): Response
	{
		$statusCode = $response->getStatusCode();
		$reasonPhrase = $response->getReasonPhrase();
		$headers = $response->getHeaders();
		$contents = $response->getBody()->getContents();

		if ($responseOption->equals(ResponseOption::JSON_ARRAY)) {
			return new JsonArrayResponse(
				$statusCode,
				$reasonPhrase,
				$headers,
				$contents
			);
		}

		if ($responseOption->equals(ResponseOption::JSON_STD_CLASS)) {
			return new JsonStdClassResponse(
				$statusCode,
				$reasonPhrase,
				$headers,
				$contents
			);
		}

		return new JsonStringResponse(
			$statusCode,
			$reasonPhrase,
			$headers,
			$contents
		);
	}

}
