<?php declare(strict_types = 1);


namespace Pd\Storage\Domain;

class FilesCollection
{

	private int $count;

	/**
	 * @var File[]
	 */
	private array $items;


	public function __construct(
		int $count,
		File ...$items
	)
	{
		$this->count = $count;
		$this->items = $items;
	}


	public function getCount(): int
	{
		return $this->count;
	}


	public function getItems(): array
	{
		return $this->items;
	}
}
