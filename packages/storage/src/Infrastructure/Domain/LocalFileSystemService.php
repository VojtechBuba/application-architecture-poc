<?php declare(strict_types = 1);


namespace Pd\Storage\Infrastructure\Domain;

use Nette\NotImplementedException;
use Pd\Storage\Domain\Exception\MovingFileFailedException;
use Pd\Storage\Domain\Extension;
use Pd\Storage\Domain\FileSystem\Directory;
use Pd\Storage\Domain\FileSystem\FileSystemService;
use Pd\Storage\Domain\FileSystem\Path;
use Pd\Storage\Domain\FileSystem\SavedFileInfo;
use Pd\Storage\Domain\Measurement\Byte;
use Pd\Storage\Infrastructure\Domain\Exception\FileWithoutSizeException;
use Psr\Http\Message\UploadedFileInterface;
use function explode;
use function mime_content_type;

class LocalFileSystemService implements FileSystemService
{

	private string $storageDirectory;

	public function __construct(
		string $storageDirectory
	)
	{
		$this->storageDirectory = $storageDirectory;
	}


	public function getStorageDirectory(): Directory
	{
		return new Directory($this->storageDirectory);
	}


	public function saveFile(UploadedFileInterface $uploadedFile, Path $targetDestination): SavedFileInfo
	{
		$pathToSaveFile = $targetDestination->moveTo($this->getStorageDirectory());

		if ( ! is_dir($pathToSaveFile->getDirectory()->getPath())) {
			\Nette\Utils\FileSystem::createDir($pathToSaveFile->getDirectory()->getPath());
		}

		try {
			$uploadedFile->moveTo($pathToSaveFile->getFullPath());
		} catch (\RuntimeException $e) {
			throw new MovingFileFailedException($e);
		}

		$fileSize = $uploadedFile->getSize();

		if ( ! $fileSize) {
			throw new MovingFileFailedException(new FileWithoutSizeException());
		}

		$extension = $this->getExtension($pathToSaveFile->getFullPath());

		return new SavedFileInfo(
			$targetDestination,
			new Byte($fileSize),
			new Extension($extension)
		);
	}


	public function deleteFile(Path $path): void
	{
		throw new NotImplementedException('Delete file is not implemented yet');
	}


	private function getExtension(string $pathToFile): string
	{
		/** @var string $mimeType */
		$mimeType = mime_content_type($pathToFile);

		[$type, $extension] = explode('/', $mimeType);

		return $extension;
	}
}
