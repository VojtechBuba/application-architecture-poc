<?php declare(strict_types = 1);

namespace Pd\StorageSDK\Resources\Files\ListCollection;

class Response
{

	private int $totalCount;

	/**
	 * @var File[]
	 */
	private array $files;


	public function __construct(
		int $totalCount,
		File ...$files
	)
	{
		$this->totalCount = $totalCount;
		$this->files = $files;
	}


	public function getTotalCount(): int
	{
		return $this->totalCount;
	}

	/**
	 * @return File[]
	 */
	public function getFiles(): array
	{
		return $this->files;
	}

}
