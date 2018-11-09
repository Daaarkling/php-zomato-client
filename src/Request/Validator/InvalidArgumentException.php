<?php declare(strict_types = 1);

namespace Darkling\ZomatoClient\Request\Validator;

use Exception;
use Throwable;

class InvalidArgumentException extends Exception
{

	public function __construct(string $argument, string $given, string $expected, ?Throwable $previous = null)
	{
		parent::__construct(sprintf('Invalid "%s" argument, given "%s", but "%s" expected.', $argument, $given, $expected), 0, $previous);
	}

}
