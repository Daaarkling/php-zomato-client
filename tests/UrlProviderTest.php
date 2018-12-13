<?php declare(strict_types = 1);

namespace Darkling\ZomatoClient\Test;

use Darkling\ZomatoClient\Request\Enum\EntityType;
use Darkling\ZomatoClient\Request\Enum\Order;
use Darkling\ZomatoClient\Request\Enum\Sort;
use Darkling\ZomatoClient\Request\Restaurant\RestaurantRequest;
use Darkling\ZomatoClient\Request\Restaurant\SearchRequest;
use Darkling\ZomatoClient\UrlProvider;
use Darkling\ZomatoClient\ZomatoClient;
use Tester\Assert;
use Tester\TestCase;
use function var_dump;

require __DIR__ . '/bootstrap.php';

/**
 * @testCase
 */
class UrlProviderTest extends TestCase
{

	public function testGetUrl(): void
	{
		$urlProvider = new UrlProvider(ZomatoClient::BASE_API_URL);
		$restaurantRequest = new RestaurantRequest(123);
		$searchRequest = SearchRequest::createFromParameters([
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

		Assert::same(
			'https://developers.zomato.com/api/v2.1/restaurant?res_id=123',
			$urlProvider->getUrl($restaurantRequest)->getAbsoluteUrl()
		);

		Assert::same(
			'https://developers.zomato.com/api/v2.1/search?entity_id=1&entity_type=city&q=magic&start=1&count=10&lat=50.5&lon=49.5&radius=125&cuisines=25%2C26&establishment_type=99&collection_id=88&category=6%2C5&sort=rating&order=asc',
			$urlProvider->getUrl($searchRequest)->getAbsoluteUrl()
		);
	}

}

(new UrlProviderTest())->run();