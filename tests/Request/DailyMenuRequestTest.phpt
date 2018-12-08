<?php declare(strict_types = 1);

namespace Darkling\ZomatoClient\Test\Request;

use Darkling\ZomatoClient\Request\Restaurant\DailyMenuRequest;
use Darkling\ZomatoClient\Request\Validator\MissingRequiredArgumentsException;
use Darkling\ZomatoClient\Request\Validator\UnknownArgumentsException;
use Tester\Assert;
use Tester\TestCase;

require __DIR__ . '/../bootstrap.php';

/**
 * @testCase
 */
class DailyMenuRequestTest extends TestCase
{

	public function testCreate(): void
	{
		$request = new DailyMenuRequest(1);
		Assert::equal(['res_id' => '1'], $request->getParameters());
		Assert::same('dailymenu', $request->getEndPoint());

		$request = DailyMenuRequest::createFromParameters(['res_id' => 2]);
		Assert::equal(['res_id' => '2'], $request->getParameters());
		Assert::same('dailymenu', $request->getEndPoint());

		Assert::exception(function () {
			DailyMenuRequest::createFromParameters([]);
		}, MissingRequiredArgumentsException::class, 'Missing required arguments: res_id');

		Assert::exception(function () {
			DailyMenuRequest::createFromParameters(['res_id' => 2, 'foo' => 10]);
		}, UnknownArgumentsException::class, 'Unknown arguments: foo');
	}

}

(new DailyMenuRequestTest())->run();