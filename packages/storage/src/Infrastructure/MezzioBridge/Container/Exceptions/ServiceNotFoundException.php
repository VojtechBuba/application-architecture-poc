<?php declare(strict_types = 1);

namespace Pd\Storage\Infrastructure\MezzioBridge\DI\Exceptions;

use Throwable;

class ServiceNotFoundException extends \Exception implements \Psr\Container\NotFoundExceptionInterface
{

	public function __construct(string $message, int $code, Throwable $exception)
	{
		parent::__construct($message, $code, $exception);
	}

}
