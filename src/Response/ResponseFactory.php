<?php declare(strict_types = 1);

namespace Darkling\ZomatoClient\Response;

use Psr\Http\Message\ResponseInterface;

interface ResponseFactory
{

	public function create(ResponseOption $responseOption, ResponseInterface $response): Response;

}
