<?php declare(strict_types = 1);


namespace Pd\StorageSDK\Resources\Files\UploadFile;


class Path
{

	private string $directory;

	private string $fileName;


	public function __construct(
		string $directory,
		string $fileName
	)
	{
		$this->directory = $directory;
		$this->fileName = $fileName;
	}


	public function getDirectory(): string
	{
		return $this->directory;
	}


	public function getFileName(): string
	{
		return $this->fileName;
	}
}
