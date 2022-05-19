<?php declare(strict_types = 1);

namespace Pd\StorageSDK\DI;

use Nette\DI\CompilerExtension;
use Nette\DI\Definitions\Statement;
use Nette\Schema\Expect;
use Nette\Schema\Schema;
use Pd\StorageSDK\Config\Config;

class StorageSDKExtension extends CompilerExtension
{

	public function getConfigSchema(): Schema
	{
		return Expect::structure([
			'basePath' => Expect::anyOf(Expect::string()),
		]);
	}


	public function loadConfiguration(): void
	{
		$basePath = $this->config->basePath;

		$builder = $this->getContainerBuilder();
		$builder->addDefinition($this->prefix('storageSdk'))
			->setFactory(Config::class, ['basePath' => $basePath])
		;

		$this->compiler->loadDefinitionsFromConfig(
			$this->loadFromFile(__DIR__ . '/storageSDK.neon')['services'],
		);
	}


}
