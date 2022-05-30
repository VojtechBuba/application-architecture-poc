<?php declare(strict_types = 1);


namespace Pd\Storage\Application;

use DateTimeInterface;
use JsonSerializable;
use Pd\Storage\Domain\FileDetail;

class FileResponse implements JsonSerializable
{

	private string $id;

	private PathResponse $path;

	private int $size;

	private string $tenantId;

	private string $extension;

	private string $created;


	public function __construct(
		string $id,
		PathResponse $path,
		int $size,
		string $tenantId,
		string $extension,
		string $created
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


	public function getPath(): PathResponse
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


	public function getCreated(): string
	{
		return $this->created;
	}


	public function jsonSerialize(): array
	{
		return [
			'id' => $this->getId(),
			'path' => $this->getPath(),
			'size' => $this->getSize(),
			'tenantId' => $this->getTenantId(),
			'extension' => $this->getExtension(),
			'created' => $this->getCreated(),
		];
	}


	public static function create(FileDetail $fileDetail): self
	{
		return new self(
			$fileDetail->getId()->getValue(),
			PathResponse::create($fileDetail->getPath()),
			$fileDetail->getSize()->getValue(),
			$fileDetail->getTenantId()->getValue(),
			$fileDetail->getExtension()->getValue(),
			$fileDetail->getCreated()->format(DateTimeInterface::W3C)
		);
	}
}
