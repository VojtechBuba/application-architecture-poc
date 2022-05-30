<?php declare(strict_types = 1);


namespace Pd\Storage\Domain\FileSystem;


use Psr\Http\Message\UploadedFileInterface;

interface FileSystemService
{

	public function getStorageDirectory(): Directory;

	public function saveFile(UploadedFileInterface $uploadedFile, Path $targetDestination): SavedFileInfo;

	public function deleteFile(Path $path): void;
}
