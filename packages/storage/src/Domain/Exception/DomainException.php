<?php declare(strict_types = 1);


namespace Pd\Storage\Domain\Exception;

use Throwable;

abstract class DomainException extends \DomainException
{
	public function __construct(string $message = "", Throwable $previous = null)
	{
		parent::__construct($message, 0, $previous);
	}
}
