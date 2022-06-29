<?php

namespace Inkl\PriceApiCom\Client;

interface ClientInterface
{
    public function call($method, $params = []);
}
