<?php declare(strict_types = 1);

namespace Pd\StorageSDK\Resources\Storage;

use GuzzleHttp\Client;
use Pd\StorageSDK\Config\Config;
use function sprintf;

class GetStorageFacade
{

	private Config $config;


	public function __construct(
		Config $config
	)
	{
		$this->config = $config;
	}


	public function execute(): string
	{
		$client = new Client(['base_uri' => $this->config->getBasePath()]);

		$response = $client->get('/ping');

		return sprintf("%s neco",$response->getBody()->getContents());
	}
}
