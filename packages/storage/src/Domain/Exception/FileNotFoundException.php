<?php declare(strict_types = 1);


namespace Pd\Storage\Domain\Exception;

use Pd\Storage\Domain\FileId;
use Throwable;

class FileNotFoundException extends NotFoundException
{
	public function __construct(FileId $id, Throwable $previous = null)
	{
		parent::__construct("File with id={$id->getValue()} not found.", $previous);
	}
}
