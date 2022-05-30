<?php declare(strict_types = 1);


namespace Pd\Storage\Domain\Exception;

use Throwable;

class ZeroPageNumberException extends DomainException
{
	public function __construct(int $page, Throwable $previous = null)
	{
		parent::__construct("Page number must be 1 or bigger, {$page} given.",  $previous);
	}
}
