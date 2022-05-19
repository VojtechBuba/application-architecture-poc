<?php declare(strict_types = 1);


namespace Pd\Storage\Domain;

interface FilesRepository
{

	public function list(TenantId $tenantId, Paging $paging);

	public function get(TenantId $tenantId, FileId $id): File;
}
