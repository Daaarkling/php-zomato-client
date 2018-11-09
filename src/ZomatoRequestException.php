<?php declare(strict_types = 1);

namespace Darkling\ZomatoClient;

use Exception;
use Throwable;

class ZomatoRequestException extends Exception
{

	public function __construct(string $url, ?Throwable $previous = null)
	{
		parent::__construct(sprintf('Request %s failed.', $url), 0, $previous);
	}

}
