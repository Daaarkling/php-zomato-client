<?php declare(strict_types = 1);

namespace Darkling\ZomatoClient\Result;

use SimpleXMLElement;
use stdClass;

interface Result
{

	public function getStatusCode(): int;

	public function getNumberOfEntities(): int;

	/**
	 * @return stdClass|SimpleXMLElement|string|null
	 */
	public function getData();

}
