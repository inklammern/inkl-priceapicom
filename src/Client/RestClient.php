<?php

namespace Inkl\PriceApiCom\Client;

use Curl\Curl;

class RestClient implements ClientInterface
{
    private Curl $curl;
    private string $endpoint;
    private string $token;

    public function __construct(
        Curl $curl,
        string $endpoint,
        string $token
    ) {
        $this->curl = $curl;
        $this->endpoint = $endpoint;
        $this->token = $token;
    }

    public function call($method, $params = [])
    {
        $url = $this->endpoint . $method;
        $params['token'] = $this->token;

        call_user_func_array([$this->curl, $this->getHttpMethod($method)], [$url, $params]);

        return $this->curl->response;
    }

    private function getHttpMethod(string $method): string
    {
        if ($method === 'jobs') {
            return 'post';
        }

        return 'get';
    }
}
