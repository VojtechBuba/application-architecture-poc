<?php declare(strict_types = 1);


namespace Pd\StorageSDK\Resources\Files\UploadFile;


class UploadedFile
{

	private string $originalName;

	private string $temporaryPath;


	public function __construct(
		string $originalName,
		string $temporaryPath
	)
	{
		$this->originalName = $originalName;
		$this->temporaryPath = $temporaryPath;
	}


	public function getOriginalName(): string
	{
		return $this->originalName;
	}


	public function getTemporaryPath(): string
	{
		return $this->temporaryPath;
	}
}
