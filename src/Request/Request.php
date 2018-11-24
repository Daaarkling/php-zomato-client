<?php declare(strict_types = 1);

namespace Darkling\ZomatoClient\Request;

interface Request
{

	public const PARAMETER_REQUIRED = 'required';
	public const PARAMETER_OPTIONAL = 'optional';

	/**
	 * Gets name of the api end point
	 *
	 * @return string
	 */
	public function getEndPoint(): string;

	/**
	 * Map of parameters corresponding with api
	 *
	 * @return string[]
	 */
	public function getParameters(): array;

}
