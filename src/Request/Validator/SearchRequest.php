<?php declare(strict_types = 1);

namespace Darkling\ZomatoClient\Request;

use Darkling\ZomatoClient\Request\Type\EntityType;
use Darkling\ZomatoClient\Request\Type\Order;
use Darkling\ZomatoClient\Request\Type\Sort;
use Darkling\ZomatoClient\Request\Validator\RequestValidator;

class SearchRequest implements Request
{

	private const END_POINT = 'search';

	private const SCHEMA = [
		self::PARAMETER_REQUIRED => [],
		self::PARAMETER_OPTIONAL => [
			'entity_id',
			'entity_type',
			'q' ,
			'start',
			'count',
			'lat',
			'lon',
			'radius',
			'cuisines',
			'establishment_type',
			'collection_id',
			'category',
			'sort',
			'order',
		],
	];

	/** @var int[]|string[]|float[]|EntityType[]|int[][]|Sort[]|Order[] */
	private $parameters;

	/**
	 * @param int|null $entityId - location id
	 * @param EntityType|null $entityType - location type
	 * @param null|string $q - search keyword
	 * @param int|null $start - fetch results after offset
	 * @param int|null $count - max number of results to display
	 * @param float|null $lat - latitude
	 * @param float|null $lon - longitude
	 * @param float|null $radius - radius around (lat,lon); to define search area, defined in meters(M)
	 * @param int[]|null $cuisines - list of cuisine id's separated by comma
	 * @param int|null $establishmentType - estblishment id obtained from establishments call
	 * @param int|null $collectionId - collection id obtained from collections call
	 * @param int[]|null $category - category ids obtained from categories call
	 * @param Sort|null $sort - sort restaurants by
	 * @param Order|null $order - used with 'sort' parameter to define ascending / descending
	 */
	public function __construct(
		?int $entityId = null,
		?EntityType $entityType = null,
		?string $q = null,
		?int $start = null,
		?int $count = null,
		?float $lat = null,
		?float $lon = null,
		?float $radius = null,
		?array $cuisines = null,
		?int $establishmentType = null,
		?int $collectionId = null,
		?array $category = null,
		?Sort $sort = null,
		?Order $order = null
	)
	{
		$this->parameters = [
			'entity_id' => $entityId,
			'entity_type' => $entityType,
			'q' => $q,
			'start' => $start,
			'count' => $count,
			'lat' => $lat,
			'lon' => $lon,
			'radius' => $radius,
			'cuisines' => $cuisines,
			'establishment_type' => $establishmentType,
			'collection_id' => $collectionId,
			'category' => $category,
			'sort' => $sort,
			'order' => $order,
		];
	}

	/**
	 * @param int[]|string[]|float[][] $parameters
	 * @return DailyMenuRequest
	 * @throws Validator\MissingRequiredArgumentsException
	 * @throws Validator\UnknownArgumentsException
	 */
	public static function createFromParameters(array $parameters): self
	{
		RequestValidator::validate(self::SCHEMA, $parameters);

		return new self(
			$parameters['res_id']
		);
	}

	public function getEndPoint(): string
	{
		return self::END_POINT;
	}

	/**
	 * @return int[]|string[]|float[]|EntityType[]|int[][]|Sort[]|Order[]
	 */
	public function getParameters(): array
	{
		return $this->parameters;
	}

}
