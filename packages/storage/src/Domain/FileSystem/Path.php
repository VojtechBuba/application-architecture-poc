<?php declare(strict_types = 1);


namespace Pd\Storage\Domain\FileSystem;

use Pd\Storage\Domain\FileSystem\Directory;
use Pd\Storage\Domain\FileSystem\FileName;

class Path
{

	private Directory $directory;

	private FileName $fileName;

	public function __construct(
		Directory $directory,
		FileName $fileName
	)
	{
		$this->directory = $directory;
		$this->fileName = $fileName;
	}


	public function moveTo(Directory $directory): self
	{
		return new Path(
			$this->directory->moveTo($directory),
			$this->fileName
		);
	}

	public function getDirectory(): Directory
	{
		return $this->directory;
	}


	public function getFileName(): FileName
	{
		return $this->fileName;
	}

	public function getFullPath(): string
	{
		return sprintf("%s/%s", $this->getDirectory()->getPath(), $this->getFileName()->getValue());
	}
}
