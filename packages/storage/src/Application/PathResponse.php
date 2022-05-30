<?php declare(strict_types = 1);


namespace Pd\Storage\Application;

use JsonSerializable;
use Pd\Storage\Domain\FileSystem\Path;

class PathResponse implements JsonSerializable
{

	private string $directory;

	private string $fileName;


	public function __construct(
		string $directory,
		string $fileName
	)
	{
		$this->directory = $directory;
		$this->fileName = $fileName;
	}


	public function getDirectory(): string
	{
		return $this->directory;
	}


	public function getFileName(): string
	{
		return $this->fileName;
	}


	public function jsonSerialize(): array
	{
		return [
			'directory' => $this->getDirectory(),
			'fileName' => $this->getFileName(),
		];
	}


	public static function create(Path $path): self
	{
		return new self(
			$path->getDirectory()->getPath(),
			$path->getFileName()->getValue(),
		);
	}
}
