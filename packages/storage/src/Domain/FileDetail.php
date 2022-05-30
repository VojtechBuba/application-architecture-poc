<?php declare(strict_types = 1);


namespace Pd\Storage\Domain;

use DateTimeImmutable;
use Pd\Storage\Domain\FileSystem\Path;
use Pd\Storage\Domain\Measurement\Byte;

class FileDetail
{

	private FileId $id;

	private Path $path;

	private Byte $size;

	private TenantId $tenantId;

	private Extension $extension;

	private DateTimeImmutable $created;


	public function __construct(
		FileId $id,
		Path $path,
		Byte $size,
		TenantId $tenantId,
		Extension $extension,
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


	public function getId(): FileId
	{
		return $this->id;
	}


	public function getPath(): Path
	{
		return $this->path;
	}


	public function getSize(): Byte
	{
		return $this->size;
	}


	public function getTenantId(): TenantId
	{
		return $this->tenantId;
	}


	public function getExtension(): Extension
	{
		return $this->extension;
	}


	public function getCreated(): DateTimeImmutable
	{
		return $this->created;
	}
}
