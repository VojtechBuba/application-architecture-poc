<?php declare(strict_types = 1);


namespace Pd\Storage\Infrastructure\Domain\Exception;

use Throwable;

class FileWithoutSizeException extends \UnexpectedValueException
{
	public function __construct(Throwable $previous = null)
	{
		parent::__construct("Unknown size of file", 0, $previous);
	}
}
