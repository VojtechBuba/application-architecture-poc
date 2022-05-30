<?php declare(strict_types = 1);


namespace Pd\Storage\Infrastructure\Domain;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Pd\Storage\Domain\Exception\FileNotFoundException;
use Pd\Storage\Domain\File;
use Pd\Storage\Domain\FileId;
use Pd\Storage\Domain\FilesCollection;
use Pd\Storage\Domain\FilesRepository;
use Pd\Storage\Domain\Paging;
use Pd\Storage\Domain\TenantId;

class DoctrineFilesRepository implements FilesRepository
{

	private EntityManagerInterface $entityManager;

	/**
	 * @var EntityRepository<File>
	 */
	private $entityRepository;


	public function __construct(
		EntityManagerInterface $entityManager
	)
	{
		$this->entityManager = $entityManager;
		$this->entityRepository = $entityManager->getRepository(File::class);
	}


	public function add(File $file): void
	{
		$this->entityManager->persist($file);
	}


	public function list(TenantId $tenantId, Paging $paging)
	{
		$query = $this->entityManager->createQueryBuilder()
			->select('file')
			->from(File::class, 'file')
			->getQuery()
			->setFirstResult($paging->getOffset())
			->setMaxResults($paging->getLimit())
		;

		$paginator = new Paginator($query);

		return new FilesCollection(
			$paginator->count(),
			...iterator_to_array($paginator)
		);
	}


	public function get(TenantId $tenantId, FileId $id): File
	{
		$result = $this->entityRepository->find($id);

		if ( ! $result instanceof File) {
			throw new FileNotFoundException($id);
		}

		return $result;
	}


	public function find(FileId $id): ?File
	{
		return $this->entityRepository->find($id);
	}
}
