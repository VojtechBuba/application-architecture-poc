<?php declare(strict_types = 1);


namespace Pd\StorageSDK\Resources\Files\UploadFile;

use DateTimeImmutable;
use DateTimeInterface;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\MultipartStream;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Utils;
use Nette\Utils\Json;
use Pd\StorageSDK\Config\Config;
use function fopen;

class UploadFileFacade
{

	private Config $config;

	public function __construct(
		Config $config
	)
	{
		$this->config = $config;
	}


	public function upload(string $tenantId, UploadedFile $uploadedFile): Response
	{
		$client = new Client(['base_uri' => $this->config->getBasePath()]);

		$request = new Request(
			'POST',
			"/files?id={$uploadedFile->getOriginalName()}&tenantId={$tenantId}",
			[],
			new MultipartStream(
				[
					[
						'name' => 'file',
						'filename' => $uploadedFile->getOriginalName(),
						'contents' => Utils::streamFor(fopen($uploadedFile->getTemporaryPath(), 'r'))
					]
				]
			)
		);

		$response = $client->send($request);
		$body = Json::decode($response->getBody()->getContents(), Json::FORCE_ARRAY);

		return new Response(
			$body['id'],
			new Path(
				$body['path']['directory'],
				$body['path']['fileName']
			),
			$body['size'],
			$body['tenantId'],
			$body['extension'],
			DateTimeImmutable::createFromFormat(DateTimeInterface::W3C, $body['created'])
		);
	}
}
