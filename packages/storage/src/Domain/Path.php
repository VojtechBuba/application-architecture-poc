<?php declare(strict_types = 1);


namespace Pd\Storage\Domain;

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
}
