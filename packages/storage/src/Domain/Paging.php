<?php declare(strict_types = 1);


namespace Pd\Storage\Domain;


use Tapclick\Templating\Domain\MediaLibrary\Exception\ZeroPageNumberException;

class Paging
{
	private int $page;

	private int $limit;


	public function __construct(
		int $page,
		int $limit
	)
	{
		if ($page < 1) {
			throw new ZeroPageNumberException($page);
		}

		$this->page = $page;
		$this->limit = $limit;
	}


	public function getPage(): int
	{
		return $this->page;
	}


	public function getLimit(): int
	{
		return $this->limit;
	}


	public function getOffset(): int
	{
		return ($this->getPage() - 1) * $this->getLimit();
	}
}
