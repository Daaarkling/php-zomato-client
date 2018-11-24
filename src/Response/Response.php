<?php declare(strict_types = 1);

namespace Darkling\ZomatoClient\Response;

interface Response
{

	/**
	 * Gets true if request was successful, false otherwise
	 *
	 * @return bool
	 */
	public function isOk(): bool;

	/**
	 * The status code is a 3-digit integer result code of the server's attempt
	 * to understand and satisfy the request.
	 *
	 * @return int
	 */
	public function getStatusCode(): int;

	/**
	 * Gets the response reason phrase associated with the status code.
	 *
	 * @return string
	 */
	public function getReasonPhrase(): string;

	/**
	 * Map of all registered headers, as original name => array of values
	 *
	 * @return string[][]
	 */
	public function getHeaders(): array;

	/**
	 * Gets requested data
	 *
	 * @return mixed
	 */
	public function getData();

}
