<?php declare(strict_types = 1);

namespace Pd\StorageSDK\Resources\Files\ListCollection;

use GuzzleHttp\Client;
use Pd\StorageSDK\Config\Config;
use function json_decode;

class ListFilesFacade
{

	private Config $config;

	public function __construct(
		Config $config
	)
	{
		$this->config = $config;
	}


	public function listFiles(): Response
	{
		$client = new Client(['base_uri' => $this->config->getBasePath()]);

		$response = $client->get('/files');

		$body = json_decode($response->getBody()->getContents());

		$files = [];

		foreach ($body->files as $file) {

			$files[] = new File(
				$file->name,
				$file->path,
				$file->url,
				$file->size
			);

		}

		return new Response(
			$body->totalCount,
			...$files
		);
	}
}
