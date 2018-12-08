<?php declare(strict_types = 1);

namespace Darkling\ZomatoClient\Response;

use Nette\Utils\Json;

class JsonArrayResponse extends BaseResponse
{

	/**
	 * @return mixed[]
	 */
	public function getData(): array
	{
		return Json::decode($this->data, Json::FORCE_ARRAY);
	}

}
