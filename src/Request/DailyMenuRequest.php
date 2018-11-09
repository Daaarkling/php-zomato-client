<?php declare(strict_types = 1);

namespace Darkling\ZomatoClient\Request;

use Darkling\ZomatoClient\Request\Validator\EndPointAssembler;
use Darkling\ZomatoClient\Request\Validator\RequestValidator;
use Dogma\Web\Url;

class DailyMenuRequest implements Request
{

	private const END_POINT = 'dailymenu';

	private const SCHEMA = [
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
		$this->url = EndPointAssembler::assembleUrl(self::END_POINT, $params);
	}

	public function getUrl(): Url
	{
		return $this->url;
	}

}
