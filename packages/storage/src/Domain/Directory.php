<?php declare(strict_types = 1);


namespace Pd\Storage\Domain;

use Pd\Storage\Domain\Exception\InvalidDirectoryNameException;
use function preg_match;
use function rtrim;
use function sprintf;

class Directory
{

	private string $path;

	public function __construct(
		string $path
	)
	{
		$this->validatePath($path);

		$this->path = rtrim($path, '/');
	}


	public function levelDown(string $path): self
	{
		return new self(
			sprintf("%s/%s", $this->getPath(), rtrim($path, '/'))
		);
	}


	public function getPath(): string
	{
		return $this->path;
	}


	private function validatePath(string $path): void
	{
		$result = preg_match('~^[a-zA-Z0-9\/\-]+$~', $path);

		if ( ! $result) {
			throw new InvalidDirectoryNameException($path);
		}
	}
}
