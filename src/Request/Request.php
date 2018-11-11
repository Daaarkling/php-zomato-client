<?php declare(strict_types = 1);

namespace Darkling\ZomatoClient\Request;

interface Request
{

	public const PARAMETER_REQUIRED = 'required';
	public const PARAMETER_OPTIONAL = 'optional';

	public function getEndPoint(): string;

	/**
	 * @return string[]
	 */
	public function getParameters(): array;

}
