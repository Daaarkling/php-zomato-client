<?php declare(strict_types = 1);

namespace Darkling\ZomatoClient\Request\Validator;

use Exception;
use Throwable;

class UnknownArgumentException extends Exception
{

	public function __construct(string $argument, ?Throwable $previous = null)
	{
		parent::__construct(sprintf('Unkown "%s" argument', $argument), 0, $previous);
	}

}
