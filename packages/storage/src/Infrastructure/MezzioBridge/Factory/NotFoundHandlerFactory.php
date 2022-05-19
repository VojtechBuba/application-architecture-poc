<?php declare(strict_types = 1);

namespace Pd\Storage\Infrastructure\MezzioBridge\Factory;

use Laminas\Diactoros\Response;
use Mezzio\Handler\NotFoundHandler;

class NotFoundHandlerFactory
{

	public function create(): NotFoundHandler
	{
		return new NotFoundHandler(
			static function () : Response {
				return new Response();
			}
		);
	}

}
