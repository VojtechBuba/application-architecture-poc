<?php declare(strict_types = 1);


namespace Pd\Storage\Application;

use Pd\Storage\Domain\Exception\DuplicitFileIdException;
use Pd\Storage\Domain\File;
use Pd\Storage\Domain\FileId;
use Pd\Storage\Domain\FilesRepository;
use Pd\Storage\Domain\FileSystem\Directory;
use Pd\Storage\Domain\FileSystem\FileName;
use Pd\Storage\Domain\FileSystem\FileSystemService;
use Pd\Storage\Domain\FileSystem\Path;
use Pd\Storage\Domain\TenantId;
use Psr\Http\Message\UploadedFileInterface;

class CreateNewFileUseCase
{

	private FilesRepository $filesRepository;

	private FileSystemService $fileSystemService;

	public function __construct(
		FilesRepository $filesRepository,
		FileSystemService $fileSystemService
	)
	{
		$this->filesRepository = $filesRepository;
		$this->fileSystemService = $fileSystemService;
	}


	/**
	 * @throws DuplicitFileIdException
	 */
	public function execute(string $id, string $tenantId, UploadedFileInterface $uploadedFile): FileResponse
	{
		$id = new FileId($id);

		$existing = $this->filesRepository->find($id);

		if ($existing) {
			throw new DuplicitFileIdException($id);
		}

		$tenantId = new TenantId($tenantId);

		$filePath = new Path(
			new Directory($tenantId->getValue()),
			new FileName($id->getValue())
		);

		$savedFile = $this->fileSystemService->saveFile($uploadedFile, $filePath);

		$file = new File(
			$id,
			$savedFile->getPath(),
			$savedFile->getSize(),
			$tenantId,
			$savedFile->getExtension()
		);

		$this->filesRepository->add($file);

		return FileResponse::create($file->getDetail());
	}
}
