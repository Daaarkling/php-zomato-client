<?php declare(strict_types = 1);

namespace Darkling\ZomatoClient;

use Exception;
use Throwable;

class InvalidOutputOptionException extends Exception
{

	public function __construct(string $option, ?Throwable $previous = null)
	{
		parent::__construct(sprintf('Invalid output option %s given', $option), 0, $previous);
	}

}
