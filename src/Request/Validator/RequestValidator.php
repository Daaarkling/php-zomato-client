<?php declare(strict_types = 1);

namespace Darkling\ZomatoClient\Request\Validator;

use Darkling\ZomatoClient\Request\Request;
use function array_key_exists;
use function array_keys;
use function in_array;

class RequestValidator
{

	/**
	 * @param string[][] $schema
	 * @param mixed[] $parameters
	 */
	public static function validate(array $schema, array $parameters): void
	{
		$missingParameters = [];
		foreach ($schema[Request::PARAMETER_REQUIRED] as $requiredParameter) {
			if (!array_key_exists($requiredParameter, $parameters)) {
				$missingParameters[] = $requiredParameter;
			}
		}

		if ($missingParameters !== []) {
			throw new MissingRequiredArgumentsException($missingParameters);
		}

		$unknownParameters = [];
		foreach (array_keys($parameters) as $parameterName) {
			if (
				!in_array($parameterName, $schema[Request::PARAMETER_REQUIRED], true)
				&& !in_array($parameterName, $schema[Request::PARAMETER_OPTIONAL], true)
			) {
				$unknownParameters[] = $parameterName;
			}
		}

		if ($unknownParameters !== []) {
			throw new UnknownArgumentsException($unknownParameters);
		}
	}

}
