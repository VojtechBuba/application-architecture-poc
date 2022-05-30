<?php declare(strict_types = 1);


namespace Pd\Storage\Domain\Exception;

use Throwable;

class UnsupportedExtensionValueException extends DomainException
{
	public function __construct(string $value, Throwable $previous = null)
	{
		parent::__construct("Extension value {$value} is not supported.", $previous);
	}
}
