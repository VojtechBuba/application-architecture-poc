<?php declare(strict_types = 1);


namespace Pd\Storage\Domain\Exception;

use Throwable;

class MovingFileFailedException extends DomainException
{
	public function __construct(Throwable $previous = null)
	{
		parent::__construct("Moving file failed.", $previous);
	}
}
