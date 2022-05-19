<?php

declare(strict_types=1);

namespace Pd\Storage\Infrastructure\Delivery\RestAPI\Resources;

use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

use function time;

class PingHandler implements RequestHandlerInterface
{
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        return new JsonResponse(['ack' => time()]);
    }
}
