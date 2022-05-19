<?php declare(strict_types = 1);

require __DIR__ . '/../bootstrap.php';

/** @var $container \Nette\DI\Container */

/** @var \Mezzio\Application $mezzioApplication */
$mezzioApplication = $container->getByType(\Mezzio\Application::class);

(require '../config/pipeline.php')($mezzioApplication);
(require '../config/routes.php')($mezzioApplication);

$mezzioApplication->run();

