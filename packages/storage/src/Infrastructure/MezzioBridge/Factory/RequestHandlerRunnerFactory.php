<?php declare(strict_types = 1);

namespace Pd\Storage\Infrastructure\MezzioBridge\Factory;

use Laminas\Diactoros\Response;
use Laminas\Diactoros\ServerRequest;
use Laminas\Diactoros\ServerRequestFactory;
use Laminas\HttpHandlerRunner\Emitter\EmitterStack;
use Laminas\HttpHandlerRunner\Emitter\SapiEmitter;
use Laminas\HttpHandlerRunner\RequestHandlerRunner;
use Laminas\Stratigility\Middleware\ErrorResponseGenerator;
use Laminas\Stratigility\MiddlewarePipeInterface;
use Throwable;

class RequestHandlerRunnerFactory
{

	private MiddlewarePipeInterface $middlewarePipe;


	public function __construct(
		MiddlewarePipeInterface $middlewarePipe
	)
	{
		$this->middlewarePipe = $middlewarePipe;
	}


	public function create(): RequestHandlerRunner
	{
		$emitter = $this->createEmitter();

		return new RequestHandlerRunner(
			$this->middlewarePipe,
			$emitter,
			static function (): ServerRequest {
				return ServerRequestFactory::fromGlobals();
			},
			static function (Throwable $e) {
				$generator = new ErrorResponseGenerator();
				return $generator($e, new ServerRequest(), new Response());
			}
		);
	}


	private function createEmitter(): EmitterStack
	{
		$stack = new EmitterStack();
		$stack->push(new SapiEmitter());

		return $stack;
	}

}
