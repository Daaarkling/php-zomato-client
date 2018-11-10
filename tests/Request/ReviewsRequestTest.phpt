<?php declare(strict_types = 1);

namespace Darkling\ZomatoClient\Test\Request;

use Darkling\ZomatoClient\Request\RestaurantRequest;
use Darkling\ZomatoClient\Request\ReviewsRequest;
use Darkling\ZomatoClient\Request\Validator\MissingRequiredArgumentsException;
use Darkling\ZomatoClient\Request\Validator\UnknownArgumentsException;
use Tester\Assert;
use Tester\TestCase;

require __DIR__ . '/../bootstrap.php';

/**
 * @testCase
 */
class ReviewsRequestTest extends TestCase
{

	public function testCreate(): void
	{
		$request = new ReviewsRequest(1, 2, 3);

		Assert::equal(['res_id' => 1, 'start' => 2, 'count' => 3], $request->getParameters());
		Assert::same('reviews', $request->getEndPoint());
	}

	public function testCreateFromParameters(): void
	{
		$request = ReviewsRequest::createFromParameters(['res_id' => 1, 'start' => 2, 'count' => 3]);

		Assert::equal(['res_id' => 1, 'start' => 2, 'count' => 3], $request->getParameters());
		Assert::same('restaurant', $request->getEndPoint());

		Assert::exception(function () {
			RestaurantRequest::createFromParameters([]);
		}, MissingRequiredArgumentsException::class, 'Missing required arguments: res_id');

		Assert::exception(function () {
			RestaurantRequest::createFromParameters(['res_id' => 2, 'foo' => 10]);
		}, UnknownArgumentsException::class, 'Unknown arguments: foo');

	}

}

(new ReviewsRequestTest())->run();