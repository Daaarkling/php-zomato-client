<?php declare(strict_types = 1);

namespace Darkling\ZomatoClient\Request\Type;

use Darkling\ZomatoClient\Request\Request;
use Darkling\ZomatoClient\Request\Validator\RequestValidator;
use Dogma\Web\Url;

class DailyMenu implements RequestType
{

	public const END_POINT = 'dailymenu';

	public const SCHEMA = [
		'res_id' => [
			RequestValidator::PARAM_REQUIRED,
			RequestValidator::PARAM_INT,
		],
	];

	/** @var Url */
	private $url;

	public function __construct(array $params)
	{
		RequestValidator::validate(self::SCHEMA, $params);
		$url = new \Nette\Http\Url(Request::URL_BASE);
		$url->appendQuery($params);

		$this->url = $url->getAbsoluteUrl();
	}

	public function getUrl(): Url
	{
		return $this->url;
	}

}
