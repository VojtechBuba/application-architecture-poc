<?php declare(strict_types = 1);

namespace Pd\StorageSDK\Config;

class Config
{

	private string $basePath;

	public function __construct(
		string $basePath
	)
	{
		$this->basePath = $basePath;
	}


	public function getBasePath(): string
	{
		return $this->basePath;
	}
}
