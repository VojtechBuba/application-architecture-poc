<?php declare(strict_types = 1);


namespace Pd\Storage\Domain\Exception;

use Throwable;

class InvalidDirectoryNameException extends DomainException
{
	public function __construct(string $path, Throwable $previous = null)
	{
		parent::__construct("Invalid directory name {$path}", $previous);
	}
}
