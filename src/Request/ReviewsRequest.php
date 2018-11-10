<?php declare(strict_types = 1);

namespace Darkling\ZomatoClient\Request;

use Darkling\ZomatoClient\Request\Validator\RequestValidator;

class ReviewsRequest implements Request
{

	private const END_POINT = 'reviews';

	private const SCHEMA = [
		self::PARAMETER_REQUIRED => [
			'res_id'
		],
		self::PARAMETER_OPTIONAL => [
			'start', 'count'
		],
	];

	/** @var int[] */
	private $parameters;

	/**
	 * @param int $resId - id of restaurant whose details are requested
	 * @param int|null $start - fetch results after this offset
	 * @param int|null $count - max number of results to retrieve
	 */
	public function __construct(int $resId, ?int $start = null, ?int $count = null)
	{
		$this->parameters = [
			'res_id' => $resId,
			'start' => $start,
			'count' => $count,
		];
	}

	/**
	 * @param int[] $parameters
	 * @return ReviewsRequest
	 * @throws Validator\MissingRequiredArgumentsException
	 * @throws Validator\UnknownArgumentsException
	 */
	public static function createFromParameters(array $parameters): self
	{
		RequestValidator::validate(self::SCHEMA, $parameters);

		return new self(
			$parameters['res_id'],
			$parameters['start'],
			$parameters['count']
		);
	}

	public function getEndPoint(): string
	{
		return self::END_POINT;
	}

	/**
	 * @return int[]
	 */
	public function getParameters(): array
	{
		return $this->parameters;
	}

}
