<?php declare(strict_types = 1);

namespace Darkling\ZomatoClient\Request\Restaurant;

use Darkling\ZomatoClient\Request\Request;
use Darkling\ZomatoClient\Request\Validator\RequestValidator;
use function array_filter;

class ReviewsRequest implements Request
{

	private const END_POINT = 'reviews';

	private const SCHEMA = [
		self::PARAMETER_REQUIRED => [
			'res_id',
		],
		self::PARAMETER_OPTIONAL => [
			'start',
			'count',
		],
	];

	/** @var string[] */
	private $parameters;

	/**
	 * @param int $resId - id of restaurant whose details are requested
	 * @param int|null $start - fetch results after this offset
	 * @param int|null $count - max number of results to retrieve
	 */
	public function __construct(int $resId, ?int $start = null, ?int $count = null)
	{
		$this->parameters = array_map('\strval', array_filter([
			'res_id' => $resId,
			'start' => $start,
			'count' => $count,
		]));
	}

	/**
	 * @param int[] $parameters
	 * @return \Darkling\ZomatoClient\Request\Restaurant\ReviewsRequest
	 */
	public static function createFromParameters(array $parameters): self
	{
		RequestValidator::validate(self::SCHEMA, $parameters);

		return new self(
			$parameters['res_id'],
			$parameters['start'] ?? null,
			$parameters['count'] ?? null
		);
	}

	public function getEndPoint(): string
	{
		return self::END_POINT;
	}

	/**
	 * @return string[]
	 */
	public function getParameters(): array
	{
		return $this->parameters;
	}

}
