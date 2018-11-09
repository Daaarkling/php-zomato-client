<?php declare(strict_types = 1);

namespace Darkling\ZomatoClient\Request\Validator;

class RequestValidator
{

	public const PARAM_REQUIRED = 'required';
	public const PARAM_OPTIONAL = 'optional';

	public const PARAM_INT = 'int';
	public const PARAM_STRING = 'string';

	/**
	 * @param string[] $schema
	 * @param string[]|int[] $parameters
	 * @throws InvalidArgumentException
	 */
	public static function validate(array $schema, array $parameters): void
	{

	}

}
