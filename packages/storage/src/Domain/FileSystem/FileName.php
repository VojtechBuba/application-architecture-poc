<?php declare(strict_types = 1);


namespace Pd\Storage\Domain\FileSystem;

use Pd\Storage\Domain\Exception\InvalidDirectoryNameException;
use Pd\Storage\Domain\Exception\UnexpectedFileNameCharacters;
use function preg_match;

class FileName
{

	private string $value;

	public function __construct(
		string $value
	)
	{
		$this->validateValue($value);

		$this->value = $value;
	}


	public function getValue(): string
	{
		return $this->value;
	}


	private function validateValue(string $value): void
	{
		$result = preg_match('~^[a-zA-Z0-9\-\.\_]+$~', $value);

		if ( ! $result) {
			throw new UnexpectedFileNameCharacters($value);
		}
	}
}
