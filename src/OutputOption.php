<?php declare(strict_types = 1);

namespace Darkling\ZomatoClient;


class OutputOption
{

	public const JSON = 'json';
	public const JSON_RAW = 'json_raw';
	public const XML = 'xml';
	public const XML_RAW = 'xml_raw';

	public const OUTPUTS = [
		self::JSON,
		self::JSON_RAW,
		self::XML,
		self::XML_RAW,
	];

	public static function isValid(string $output): bool
	{
		return in_array($output, self::OUTPUTS, true);
	}

	public static function getContentType(string $output): string
	{
		if ($output === self::JSON || $output === self::JSON_RAW) {
			return 'application/json';
		}

		if ($output === self::XML || $output === self::XML_RAW) {
			return 'application/xml';
		}

		throw new InvalidOutputOptionException($output);
	}

}
