<?php declare(strict_types = 1);


namespace Pd\Storage\Domain\FileSystem;

use Pd\Storage\Domain\Extension;
use Pd\Storage\Domain\Measurement\Byte;

class SavedFileInfo
{

	private Path $path;

	private Byte $size;

	private Extension $extension;


	public function __construct(
		Path $path,
		Byte $size,
		Extension $extension
	)
	{
		$this->path = $path;
		$this->size = $size;
		$this->extension = $extension;
	}


	public function getPath(): Path
	{
		return $this->path;
	}


	public function getSize(): Byte
	{
		return $this->size;
	}


	public function getExtension(): Extension
	{
		return $this->extension;
	}
}
