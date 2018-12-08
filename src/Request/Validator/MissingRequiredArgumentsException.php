<?php declare(strict_types = 1);

namespace Darkling\ZomatoClient\Request\Validator;

use Exception;
use Throwable;
use function implode;
use function ksort;

class MissingRequiredArgumentsException extends Exception
{

	/**
	 * @param string[] $arguments
	 * @param \Throwable|null $previous
	 */
	public function __construct(array $arguments, ?Throwable $previous = null)
	{
		ksort($arguments);
		parent::__construct(sprintf('Missing required arguments: %s', implode(', ', $arguments)), 0, $previous);
	}

}
