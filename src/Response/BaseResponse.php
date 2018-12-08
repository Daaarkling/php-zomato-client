<?php declare(strict_types = 1);

namespace Darkling\ZomatoClient\Response;

use Dogma\Http\HttpResponseStatus;

abstract class BaseResponse implements Response
{

	/** @var int */
	private $statusCode;

	/** @var string */
	private $reasonPhrase;

	/** @var string[][] */
	private $headers;

	/** @var mixed */
	protected $data;

	/**
	 * @param int $statusCode
	 * @param string $reasonPhrase
	 * @param string[][] $headers
	 * @param mixed $data
	 */
	public function __construct(int $statusCode, string $reasonPhrase, array $headers, $data)
	{
		$this->statusCode = $statusCode;
		$this->reasonPhrase = $reasonPhrase;
		$this->headers = $headers;
		$this->data = $data;
	}

	public function isOk(): bool
	{
		return $this->statusCode === HttpResponseStatus::S200_OK;
	}

	public function getStatusCode(): int
	{
		return $this->statusCode;
	}

	public function getReasonPhrase(): string
	{
		return $this->reasonPhrase;
	}

	/**
	 * @return string[][]
	 */
	public function getHeaders(): array
	{
		return $this->headers;
	}

}
