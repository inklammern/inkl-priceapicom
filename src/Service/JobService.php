<?php

namespace Inkl\PriceApiCom\Service;

use Inkl\PriceApiCom\Client\RestClient;

class JobService
{

	/** @var RestClient */
	private $client;

	/**
	 * ProductService constructor.
	 * @param RestClient $client
	 */
	public function __construct(RestClient $client)
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
