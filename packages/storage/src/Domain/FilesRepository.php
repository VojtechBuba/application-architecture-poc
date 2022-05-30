<?php declare(strict_types = 1);


namespace Pd\Storage\Domain;

interface FilesRepository
{

	public function add(File $file): void;

	public function list(TenantId $tenantId, Paging $paging);

	public function get(TenantId $tenantId, FileId $id): File;

	public function find(FileId $id): ?File;
}
