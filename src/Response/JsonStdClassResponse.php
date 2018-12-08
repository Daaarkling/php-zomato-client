<?php declare(strict_types = 1);

namespace Darkling\ZomatoClient\Response;

use Nette\Utils\Json;
use stdClass;

class JsonStdClassResponse extends BaseResponse
{

	public function getData(): stdClass
	{
		return Json::decode($this->data);
	}

}
