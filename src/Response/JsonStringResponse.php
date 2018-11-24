<?php declare(strict_types = 1);

namespace Darkling\ZomatoClient\Response;

class JsonStringResponse extends BaseResponse
{

	public function getData(): string
	{
		return $this->data;
	}

}
