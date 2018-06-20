<?php

namespace Inkl\PriceApiCom\Service;

use Inkl\PriceApiCom\Client\ClientInterface;
use Inkl\PriceApiCom\Client\RestClient;
class JobService
{

	/** @var ClientInterface */
	private $client;

	/**
	 * ProductService constructor.
	 * @param ClientInterface $client
	 */
	public function __construct(ClientInterface $client)
	{
		$this->client = $client;
	}


	/**
	 * Check status of bulk request
	 *
	 * @param $jobId
	 * @return array|mixed
	 */
	public function getStatus($jobId)
	{
		return json_decode($this->client->call(sprintf('jobs/%s', $jobId)), true);
	}

}
