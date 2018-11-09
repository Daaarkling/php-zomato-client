<?php declare(strict_types = 1);

namespace Darkling\ZomatoClient\Result;

class EmptyResult implements Result
{

	/** @var int */
	private $statusCode;

	public function __construct(int $statusCode)
	{
		$this->statusCode = $statusCode;
	}

	public function getStatusCode(): int
	{
		return $this->statusCode;
	}

	public function getNumberOfEntities(): int
	{
		return 0;
	}

	public function getData()
	{
		return null;
	}

}
