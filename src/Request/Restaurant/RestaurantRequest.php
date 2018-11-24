<?php declare(strict_types = 1);

namespace Darkling\ZomatoClient\Request\Restaurant;

use function array_map;
use Darkling\ZomatoClient\Request\Request;
use Darkling\ZomatoClient\Request\Validator\MissingRequiredArgumentsException;
use Darkling\ZomatoClient\Request\Validator\RequestValidator;
use Darkling\ZomatoClient\Request\Validator\UnknownArgumentsException;

class RestaurantRequest implements Request
{

	private const END_POINT = 'restaurant';

	private const SCHEMA = [
		self::PARAMETER_REQUIRED => [
			'res_id'
		],
		self::PARAMETER_OPTIONAL => [],
	];

	/** @var string[] */
	private $parameters;

	/**
	 * @param int $resId - id of restaurant whose details are requested
	 */
	public function __construct(int $resId)
	{
		$this->parameters = array_map('\strval', [
			'res_id' => $resId,
		]);
	}

	/**
	 * @param int[] $parameters
	 * @return RestaurantRequest
	 * @throws MissingRequiredArgumentsException
	 * @throws UnknownArgumentsException
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
	 * @return string[]
	 */
	public function getParameters(): array
	{
		return $this->parameters;
	}

}
