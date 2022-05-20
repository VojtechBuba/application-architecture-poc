<?php declare(strict_types = 1);

namespace Pd\StorageSDK\Resources\Files\ListCollection;

class File
{

	private string $name;

	private string $path;

	private string $url;

	private int $size;


	public function __construct(
		string $name,
		string $path,
		string $url,
		int $size
	)
	{
		$this->name = $name;
		$this->path = $path;
		$this->url = $url;
		$this->size = $size;
	}


	public function getName(): string
	{
		return $this->name;
	}


	public function getPath(): string
	{
		return $this->path;
	}


	public function getUrl(): string
	{
		return $this->url;
	}


	public function getSize(): int
	{
		return $this->size;
	}

}
