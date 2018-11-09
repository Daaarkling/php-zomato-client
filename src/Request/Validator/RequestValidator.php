<?php declare(strict_types = 1);

namespace Darkling\ZomatoClient\Request\Validator;

use function array_key_exists;
use function array_keys;
use function is_int;
use function is_string;

class RequestValidator
{

	public const PARAM_REQUIRED = 'required';
	public const PARAM_OPTIONAL = 'optional';

	public const PARAM_INT = 'int';
	public const PARAM_STRING = 'string';

	/**
	 * @param string[] $schema
	 * @param string[]|int[] $params
	 * @throws InvalidArgumentException
	 * @throws MissingRequiredArgumentException
	 * @throws UnknownArgumentException
	 */
	public static function validate(array $schema, array $params): void
	{
		$paramsNames = array_keys($params);
		$schemaNames = array_keys($params);

		foreach ($paramsNames as $paramsName) {
			if (!array_key_exists($paramsName, $schemaNames)) {
				throw new UnknownArgumentException($paramsName);
			}

			if (!is_string($paramsNames[$paramsName]) && array_key_exists(self::PARAM_STRING, $schemaNames[$paramsName])) {
				throw new InvalidArgumentException($paramsName, $paramsNames[$paramsName], self::PARAM_STRING);
			}

			if (!is_int($paramsNames[$paramsName]) && array_key_exists(self::PARAM_INT, $schemaNames[$paramsName])) {
				throw new InvalidArgumentException($paramsName, $paramsNames[$paramsName], self::PARAM_INT);
			}
		}

		foreach ($schemaNames as $schemaName) {
			if (!array_key_exists($schemaName, $paramsNames) && array_key_exists(self::PARAM_REQUIRED, $schema[$schemaName])) {
				throw new MissingRequiredArgumentException($schemaName);
			}
		}

	}

}
