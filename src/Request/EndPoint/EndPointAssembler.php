<?php declare(strict_types = 1);

namespace Darkling\ZomatoClient\Request\Validator;

use Nette\Http\Url;

class EndPointAssembler
{

	private const URL_BASE = 'https://developers.zomato.com/api/v2.1/';

	/**
	 * @param string $endPoint
	 * @param string[]|int[] $params
	 * @return \Nette\Http\Url
	 */
	public static function assembleUrl(string $endPoint, array $params): Url
	{
		$url = new Url(self::URL_BASE . $endPoint);
		$url->appendQuery($params);
		return $url;
	}

}
