<?php

namespace Inkl\PriceApiCom\Service;

use Inkl\PriceApiCom\Client\RestClient;

class ProductService
{
	/** @var RestClient */
	private $client;
	/** @var JobService */
	private $jobService;

	/**
	 * ProductService constructor.
	 * @param RestClient $client
	 * @param JobService $jobService
	 */
	public function __construct(RestClient $client, JobService $jobService)
	{
		$this->client = $client;
		$this->jobService = $jobService;
	}


	/**
	 * Search single product
	 *
	 * @param $value
	 * @param string $key
	 * @param string $country
	 * @param string $source
	 * @return array|mixed
	 */
	public function getSingle($value, $key = 'gtin', $country = 'de', $source = 'idealo')
	{
		return json_decode($this->client->call('products/single'), [
			'value' => $value,
			'key' => $key,
			'country' => $country,
			'source' => $source
		], true);
	}


	/**
	 * Request many products in bulk
	 *
	 * @param array $values
	 * @param string $key
	 * @param string $country
	 * @param string $source
	 * @return array|mixed
	 */
	public function createBulkJob($values, $key = 'gtin', $country = 'de', $source = 'idealo')
	{
		return json_decode($this->client->call('jobs'), [
			'values' => implode("\n", $values),
			'key' => $key,
			'country' => $country,
			'source' => $source
		], true);
	}


	/**
	 * Check status of bulk request
	 *
	 * @param $jobId
	 * @return array|mixed
	 */
	public function checkBulkJob($jobId)
	{
		return $this->jobService->getStatus($jobId);
	}


	/**
	 * Download bulk results as JSON
	 *
	 * @param $jobId
	 * @return array|mixed
	 */
	public function getBulkJob($jobId)
	{
		return json_decode($this->client->call(sprintf('products/bulk/%s', $jobId)), true);
	}

}
