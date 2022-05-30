<?php declare(strict_types = 1);


namespace Pd\Storage\Infrastructure\Delivery\RestAPI\Middleware;

use Doctrine\ORM\EntityManagerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class PersistenceMiddleware implements MiddlewareInterface
{

	private EntityManagerInterface $entityManager;


	public function __construct(
		EntityManagerInterface $entityManager
	)
	{
		$this->entityManager = $entityManager;
	}


	public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
	{
		$response = $handler->handle($request);
		$this->entityManager->flush();

		return $response;
	}
}
