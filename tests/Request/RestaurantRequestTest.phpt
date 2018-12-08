<?php declare(strict_types = 1);

namespace Darkling\ZomatoClient\Test\Request;

use Darkling\ZomatoClient\Request\Restaurant\RestaurantRequest;
use Darkling\ZomatoClient\Request\Validator\MissingRequiredArgumentsException;
use Darkling\ZomatoClient\Request\Validator\UnknownArgumentsException;
use Tester\Assert;
use Tester\TestCase;

require __DIR__ . '/../bootstrap.php';

/**
 * @testCase
 */
class RestaurantRequestTest extends TestCase
{

	public function testCreate(): void
	{
		$request = new RestaurantRequest(1);
		Assert::equal(['res_id' => '1'], $request->getParameters());
		Assert::same('restaurant', $request->getEndPoint());

		$request = RestaurantRequest::createFromParameters(['res_id' => 2]);
		Assert::equal(['res_id' => '2'], $request->getParameters());
		Assert::same('restaurant', $request->getEndPoint());

		Assert::exception(function () {
			RestaurantRequest::createFromParameters([]);
		}, MissingRequiredArgumentsException::class, 'Missing required arguments: res_id');

		Assert::exception(function () {
			RestaurantRequest::createFromParameters(['res_id' => 2, 'foo' => 10]);
		}, UnknownArgumentsException::class, 'Unknown arguments: foo');
	}

}

(new RestaurantRequestTest())->run();