<?php declare(strict_types = 1);

namespace Darkling\ZomatoClient\Request\Restaurant;

use Darkling\ZomatoClient\Request\Enum\EntityType;
use Darkling\ZomatoClient\Request\Enum\Order;
use Darkling\ZomatoClient\Request\Enum\Sort;
use Darkling\ZomatoClient\Request\Request;
use Darkling\ZomatoClient\Request\Validator\RequestValidator;
use function array_filter;
use function implode;

class SearchRequest implements Request
{

	private const END_POINT = 'search';

	private const SCHEMA = [
		self::PARAMETER_REQUIRED => [],
		self::PARAMETER_OPTIONAL => [
			'entity_id',
			'entity_type',
			'q',
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

	/** @var string[] */
	private $parameters;

	/**
	 * @param int|null $entityId - location id
	 * @param \Darkling\ZomatoClient\Request\Enum\EntityType|null $entityType - location type
	 * @param string|null $q - search keyword
	 * @param int|null $start - fetch results after offset
	 * @param int|null $count - max number of results to display
	 * @param float|null $lat - latitude
	 * @param float|null $lon - longitude
	 * @param float|null $radius - radius around (lat,lon); to define search area, defined in meters(M)
	 * @param int[]|null $cuisines - list of cuisine id's separated by comma
	 * @param int|null $establishmentType - estblishment id obtained from establishments call
	 * @param int|null $collectionId - collection id obtained from collections call
	 * @param int[]|null $category - category ids obtained from categories call
	 * @param \Darkling\ZomatoClient\Request\Enum\Sort|null $sort - sort restaurants by
	 * @param \Darkling\ZomatoClient\Request\Enum\Order|null $order - used with 'sort' parameter to define ascending / descending
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
		$this->parameters = array_map('\strval', array_filter([
			'entity_id' => $entityId,
			'entity_type' => $entityType !== null ? $entityType->getValue() : null,
			'q' => $q,
			'start' => $start,
			'count' => $count,
			'lat' => $lat,
			'lon' => $lon,
			'radius' => $radius,
			'cuisines' => $cuisines !== null ? implode(',', $cuisines) : null,
			'establishment_type' => $establishmentType,
			'collection_id' => $collectionId,
			'category' => $category !== null ? implode(',', $category) : null,
			'sort' => $sort !== null ? $sort->getValue() : null,
			'order' => $order !== null ? $order->getValue() : null,
		]));
	}

	/**
	 * @param mixed[] $parameters
	 * @return \Darkling\ZomatoClient\Request\Restaurant\SearchRequest
	 */
	public static function createFromParameters(array $parameters): self
	{
		RequestValidator::validate(self::SCHEMA, $parameters);

		return new self(
			$parameters['entity_id'] ?? null,
			$parameters['entity_type'] ?? null,
			$parameters['q'] ?? null,
			$parameters['start'] ?? null,
			$parameters['count'] ?? null,
			$parameters['lat'] ?? null,
			$parameters['lon'] ?? null,
			$parameters['radius'] ?? null,
			$parameters['cuisines'] ?? null,
			$parameters['establishment_type'] ?? null,
			$parameters['collection_id'] ?? null,
			$parameters['category'] ?? null,
			$parameters['sort'] ?? null,
			$parameters['order'] ?? null
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
