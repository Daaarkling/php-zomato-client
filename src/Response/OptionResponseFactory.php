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

		if ($responseOption === ResponseOption::JSON_ARRAY) {
			return new JsonArrayResponse(
				$statusCode,
				$reasonPhrase,
				$headers,
				$contents
			);
		}

		if ($responseOption === ResponseOption::JSON_STD_CLASS) {
			return new JsonStdClassResponse(
				$statusCode,
				$reasonPhrase,
				$headers,
				$contents
			);
		}

		if ($responseOption === ResponseOption::SIMPLE_XML) {
			return new SimpleXmlResponse(
				$statusCode,
				$reasonPhrase,
				$headers,
				$contents
			);
		}

		if ($responseOption === ResponseOption::DOM) {
			return new DomResponse(
				$statusCode,
				$reasonPhrase,
				$headers,
				$contents
			);
		}

		if ($responseOption === ResponseOption::XML_STRING) {
			return new XmlStringResponse(
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
