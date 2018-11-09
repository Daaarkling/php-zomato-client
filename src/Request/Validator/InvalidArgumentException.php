<?php declare(strict_types = 1);

namespace Darkling\ZomatoClient\Request\Validator;

use Exception;
use Throwable;

class InvalidArgumentException extends Exception
{

	public function __construct(string $request, string $reason, ?Throwable $previous = null)
	{
		parent::__construct(sprintf('Todo', $reason, $reason), 0, $previous);
	}

}
