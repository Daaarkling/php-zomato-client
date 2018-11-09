<?php declare(strict_types = 1);

namespace Darkling\ZomatoClient\Request\Validator;

use Exception;
use Throwable;
use function implode;

class MissingRequiredArgumentException extends Exception
{

	/**
	 * @param string[] $arguments
	 * @param Throwable|null $previous
	 */
	public function __construct(array $arguments, ?Throwable $previous = null)
	{
		parent::__construct(sprintf('Missing required argument: %s', implode(',', $arguments)), 0, $previous);
	}

}
