<?php declare(strict_types = 1);


namespace Pd\Storage\Infrastructure\Delivery\RestAPI\Resources\Files;

use Laminas\Diactoros\Response\JsonResponse;
use Pd\Storage\Application\CreateNewFileUseCase;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use function reset;

class CreateNewFileHandler implements RequestHandlerInterface
{

	private CreateNewFileUseCase $createNewFileUseCase;

	public function __construct(
		CreateNewFileUseCase $createNewFileUseCase
	)
	{
		$this->createNewFileUseCase = $createNewFileUseCase;
	}


	public function handle(ServerRequestInterface $request): ResponseInterface
	{
		$query = $request->getQueryParams();

		$files = $request->getUploadedFiles();

		$first = reset($files);

		$fileResponse = $this->createNewFileUseCase->execute($query['id'], $query['tenantId'], $first);

		return new JsonResponse($fileResponse);
	}
}
