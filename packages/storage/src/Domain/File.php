<?php declare(strict_types = 1);

namespace Pd\Storage\Domain;

use DateTimeImmutable;

class File
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
		Extension $extension
	)
	{
		$this->id = $id;
		$this->path = $path;
		$this->size = $size;
		$this->tenantId = $tenantId;
		$this->extension = $extension;
		$this->created = new DateTimeImmutable();
	}
}
