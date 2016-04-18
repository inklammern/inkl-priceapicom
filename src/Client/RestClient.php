<?php

namespace Inkl\PriceApiCom\Client;

use Curl\Curl;

class RestClient implements ClientInterface {

	/** @var Curl */
	private $curl;
	/** @var string */
	private $token;

	/**
	 * Soap constructor.
	 * @param Curl $curl
	 * @param $token
	 */
    public function __construct(Curl $curl, $token) {
		$this->curl = $curl;
		$this->token = $token;
	}


    public function call($method, $params = []) {

		$url = 'http://api.priceapi.com/' . $method;
		$params['token'] = $this->token;

		call_user_func_array([$this->curl, $this->getHttpMethod($method)], [$url, $params]);

		return $this->curl->response;
    }


	private function getHttpMethod($method)
	{
		switch ($method)
		{
			case 'jobs':
				return 'post';
		}

		return 'get';
	}

}
