<?php declare(strict_types = 1);

namespace Darkling\ZomatoClient\Test\Request;

use Darkling\ZomatoClient\Request\Restaurant\SearchRequest;
use Darkling\ZomatoClient\Request\Enum\EntityType;
use Darkling\ZomatoClient\Request\Enum\Order;
use Darkling\ZomatoClient\Request\Enum\Sort;
use Darkling\ZomatoClient\Request\Validator\UnknownArgumentsException;
use Tester\Assert;
use Tester\TestCase;

require __DIR__ . '/../bootstrap.php';

/**
 * @testCase
 */
class SearchRequestTest extends TestCase
{

	public function testCreate(): void
	{
		$request = new SearchRequest(1, EntityType::get(EntityType::METRO), 'boss');
		Assert::equal(['entity_id' => '1', 'entity_type' => 'metro', 'q' => 'boss'], $request->getParameters());
		Assert::same('search', $request->getEndPoint());

		$request = SearchRequest::createFromParameters([
			'entity_id' => 1,
			'entity_type' => EntityType::get(EntityType::CITY),
			'q' => 'magic',
			'start' => 1,
			'count' => 10,
			'lat' => 50.5,
			'lon' => 49.5,
			'radius' => 125,
			'cuisines' => [25, 26],
			'establishment_type' => 99,
			'collection_id' => 88,
			'category' => [6, 5],
			'sort' => Sort::get(Sort::RATING),
			'order' => Order::get(Order::ASC),
		]);

		$expected = [
			'entity_id' => '1',
			'entity_type' => 'city',
			'q' => 'magic',
			'start' => '1',
			'count' => '10',
			'lat' => '50.5',
			'lon' => '49.5',
			'radius' => '125',
			'cuisines' => '25,26',
			'establishment_type' => '99',
			'collection_id' => '88',
			'category' => '6,5',
			'sort' => 'rating',
			'order' => 'asc',
		];

		Assert::equal($expected, $request->getParameters());
		Assert::same('search', $request->getEndPoint());

		Assert::exception(function () {
			SearchRequest::createFromParameters(['bar' => 2, 'foo' => 10]);
		}, UnknownArgumentsException::class, 'Unknown arguments: bar, foo');

	}

}

(new SearchRequestTest())->run();