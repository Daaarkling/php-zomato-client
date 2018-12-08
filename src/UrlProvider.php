<?php declare(strict_types = 1);

namespace Darkling\ZomatoClient;

use Darkling\ZomatoClient\Request\Request;
use Nette\Http\Url;

class UrlProvider
{

	/** @var \Nette\Http\Url */
	private $baseUrl;

	public function __construct(string $baseUrl)
	{
		$this->baseUrl = new Url($baseUrl);
	}

	public function getUrl(Request $request): Url
	{
		$url = new Url($this->baseUrl->getAbsoluteUrl() . $request->getEndPoint());
		$url->appendQuery($request->getParameters());
		return $url;
	}

}
