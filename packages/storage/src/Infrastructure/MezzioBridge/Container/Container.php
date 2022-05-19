<?php declare(strict_types = 1);

namespace Pd\Storage\Infrastructure\MezzioBridge\Container;

use Pd\Storage\Infrastructure\MezzioBridge\Container\Exceptions\ContainerException;
use Pd\Storage\Infrastructure\MezzioBridge\DI\Exceptions\ServiceNotFoundException;

class Container implements \Psr\Container\ContainerInterface
{

	/**
	 * @var \Nette\DI\Container
	 */
	private $container;


	public function __construct(
		\Nette\DI\Container $container
	) {
		$this->container = $container;
	}


	public function get($id)
	{
		try {
			return \class_exists($id) ? $this->container->getByType($id) : $this->container->getService($id);

		} catch (\Nette\DI\MissingServiceException $exception) {
			throw new ServiceNotFoundException(
				$exception->getMessage(),
				$exception->getCode(),
				$exception
			);

		} catch (\Throwable $exception) {
			throw new ContainerException(
				$exception->getMessage(),
				$exception->getCode(),
				$exception
			);
		}
	}


	public function has($id)
	{
		if (\class_exists($id)) {
			return (bool) $this->container->getByType($id, FALSE);
		}

		return $this->container->hasService($id);
	}
}
