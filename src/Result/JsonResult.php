<?php declare(strict_types = 1);

namespace Darkling\ZomatoClient\Result;

class JsonResult implements Result
{

	/** @var int */
	private $statusCode;

	/** @var int */
	private $numberOfEntities;

	/** @var string */
	private $data;

	public function __construct(int $statusCode, string $data)
	{
		$this->statusCode = $statusCode;
		$this->data = $data;
	}

	public function getStatusCode(): int
	{
		return $this->statusCode;
	}

	public function getNumberOfEntities(): int
	{
		return $this->numberOfEntities;
	}

	public function getData(): string
	{
		return $this->data;
	}

}
