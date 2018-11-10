<?php declare(strict_types = 1);

namespace Darkling\ZomatoClient\Request\Validator;

use Exception;
use Throwable;
use function implode;

class UnknownArgumentsException extends Exception
{

	/**
	 * @param string[] $arguments
	 * @param Throwable|null $previous
	 */
	public function __construct(array $arguments, ?Throwable $previous = null)
	{
		parent::__construct(sprintf('Unknown arguments: %s', implode(',', $arguments)), 0, $previous);
	}

}