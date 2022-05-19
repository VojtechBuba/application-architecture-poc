<?php declare(strict_types = 1);

namespace Pd\Storage\Infrastructure\MezzioBridge\DI;

use Laminas\Diactoros\Uri;
use Nette\Schema\Expect;
use Nette\Schema\Schema;
use Pd\Storage\Infrastructure\MezzioBridge\Container\Container;
use Pd\Storage\Infrastructure\MezzioBridge\Factory\NotFoundHandlerFactory;
use Pd\Storage\Infrastructure\MezzioBridge\Factory\RequestHandlerRunnerFactory;

class MezzioDependencyInjectionBridgeExtension extends \Nette\DI\CompilerExtension
{

	public function getConfigSchema(): Schema
	{
		return Expect::structure([
			'url' => Expect::anyOf(Expect::string()),
		]);
	}

	public function loadConfiguration(): void
	{
		$config = (array) $this->config;

		$builder = $this->getContainerBuilder();

		$builder->addDefinition($this->prefix('psrContainer'))
			->setFactory(Container::class)
		;

		$builder->addDefinition($this->prefix('application'))
			->setFactory(\Mezzio\Application::class, ['pipeline' => $this->prefix('@middlewarePipe')])
		;

		/** Middleware pipeline */

		$builder->addDefinition($this->prefix('middlewareContainer'))
			->setFactory(\Mezzio\MiddlewareContainer::class)
			->setAutowired(FALSE)
		;

		$builder->addDefinition($this->prefix('middlewareFactory'))
			->setFactory(\Mezzio\MiddlewareFactory::class, [$this->prefix('@middlewareContainer')])
		;

		$builder->addDefinition($this->prefix('middlewarePipe'))
			->setFactory(\Laminas\Stratigility\MiddlewarePipe::class)
			->setAutowired(FALSE)
		;

		/** Routing */

		$builder->addDefinition($this->prefix('laminasRouter'))
			->setFactory(\Mezzio\Router\LaminasRouter::class)
		;

		$builder->addDefinition($this->prefix('routeCollector'))
			->setFactory(\Mezzio\Router\RouteCollector::class)
		;

		/** Request handling */

		$builder->addDefinition($this->prefix('requestHandlerRunnerFactory'))
			->setFactory(RequestHandlerRunnerFactory::class, [$this->prefix('@middlewarePipe')])
		;

		$builder->addDefinition($this->prefix('requestHandlerRunner'))
			->setClass(\Laminas\HttpHandlerRunner\RequestHandlerRunner::class)
			->setFactory($this->prefix('@requestHandlerRunnerFactory::create'))
		;

		/**
		 * Expressive Middleware
		 */

		$builder->addDefinition($this->prefix('routeMiddleware'))
			->setFactory(\Mezzio\Router\Middleware\RouteMiddleware::class)
		;

		$builder->addDefinition($this->prefix('notFoundHandlerFactory'))
			->setFactory(NotFoundHandlerFactory::class)
		;

		$builder->addDefinition($this->prefix('notFoundHandler'))
			->setClass(\Mezzio\Handler\NotFoundHandler::class)
			->setFactory($this->prefix('@notFoundHandlerFactory::create'))
		;

		/** ServerUrl */

		$builder->addDefinition($this->prefix('serverUrlHelper'))
			->setFactory(\Mezzio\Helper\ServerUrlHelper::class)
			->addSetup('setUri', [new Uri($config['url'])])
		;

		$builder->addDefinition($this->prefix('serverUrlMiddleware'))
			->setFactory(\Mezzio\Helper\ServerUrlMiddleware::class)
		;

		/** UrlHelper */

		$builder->addDefinition($this->prefix('urlHelper'))
			->setFactory(\Mezzio\Helper\UrlHelper::class)
		;

		$builder->addDefinition($this->prefix('urlHelperMiddleware'))
			->setFactory(\Mezzio\Helper\UrlHelperMiddleware::class)
		;
	}

}
