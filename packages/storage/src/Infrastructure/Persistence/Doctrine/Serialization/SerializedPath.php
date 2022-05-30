<?php declare(strict_types = 1);


namespace Pd\Storage\Infrastructure\Persistence\Doctrine\Serialization;

use JsonSerializable;
use Pd\Storage\Domain\FileSystem\Directory;
use Pd\Storage\Domain\FileSystem\FileName;
use Pd\Storage\Domain\FileSystem\Path;

class SerializedPath implements JsonSerializable
{

	private Path $path;

	public function __construct(
		Path $path
	)
	{
		$this->path = $path;
	}


	public static function deserialize(array $data): Path
	{
		return new Path(
			new Directory($data['directory']),
			new FileName($data['fileName'])
		);
	}


	public function jsonSerialize(): array
	{
		return [
			'directory' => $this->path->getDirectory()->getPath(),
			'fileName' => $this->path->getFileName()->getValue(),
		];
	}
}
