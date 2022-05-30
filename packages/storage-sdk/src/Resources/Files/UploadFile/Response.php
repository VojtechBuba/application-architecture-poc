<?php declare(strict_types = 1);


namespace Pd\StorageSDK\Resources\Files\UploadFile;

use DateTimeImmutable;

class Response
{

	private string $id;

	private Path $path;

	private int $size;

	private string $tenantId;

	private string $extension;

	private DateTimeImmutable $created;


	public function __construct(
		string $id,
		Path $path,
		int $size,
		string $tenantId,
		string $extension,
		DateTimeImmutable $created
	)
	{
		$this->id = $id;
		$this->path = $path;
		$this->size = $size;
		$this->tenantId = $tenantId;
		$this->extension = $extension;
		$this->created = $created;
	}


	public function getId(): string
	{
		return $this->id;
	}


	public function getPath(): Path
	{
		return $this->path;
	}


	public function getSize(): int
	{
		return $this->size;
	}


	public function getTenantId(): string
	{
		return $this->tenantId;
	}


	public function getExtension(): string
	{
		return $this->extension;
	}


	public function getCreated(): DateTimeImmutable
	{
		return $this->created;
	}
}
