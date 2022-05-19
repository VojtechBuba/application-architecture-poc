<?php

use Nette\Configurator;

require __DIR__ . '/../../../../vendor/autoload.php';

$configurator = new Nette\Configurator;

//$configurator->setDebugMode('23.75.345.200'); // enable for your remote IP
$configurator->enableTracy(__DIR__ . '/log');
\Tracy\Debugger::$showBar = FALSE;

$configurator->setTimeZone('Europe/Prague');
$configurator->setTempDirectory(__DIR__ . '/../../../temp');

$configurator->addParameters([
	'srcDir' => __DIR__ . '/../../../src',
	'rootDir' => __DIR__ . '/../../..',
	'php' => '/opt/homebrew/bin/php'
]);

$configurator->addConfig(__DIR__ . '/Config/config.neon');

$customConfigFile = getenv('CONFIG_FILE');
$customConfigFilePath = __DIR__ . '/Config/' . $customConfigFile;

if ($customConfigFile && file_exists($customConfigFilePath)) {
	$configurator->addConfig($customConfigFilePath);
}

$localConfig = __DIR__ . '/Config/config.local.neon';

if (file_exists($localConfig)) {
	$configurator->addConfig($localConfig);
}

$container = $configurator->createContainer();


return $container;
