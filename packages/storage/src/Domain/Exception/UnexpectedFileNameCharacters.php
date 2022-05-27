<?php declare(strict_types = 1);


namespace Pd\Storage\Domain\Exception;


use Throwable;

class UnexpectedFileNameCharacters extends DomainException
{
	public function __construct(string $value, Throwable $previous = null)
	{
		parent::__construct("File name {$value} contains unsupported characters.", $previous);
	}
}
