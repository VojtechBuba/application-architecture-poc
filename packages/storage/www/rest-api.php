<?php declare(strict_types = 1);

require __DIR__ . '/../src/bootstrap.php';

/** @var $container \Nette\DI\Container */

/** @var \Mezzio\Application $mezzioApplication */
$mezzioApplication = $container->getByType(\Mezzio\Application::class);

(require '../src/Infrastructure/Delivery/RestAPI/config/pipeline.php')($mezzioApplication);
(require '../src/Infrastructure/Delivery/RestAPI/config/routes.php')($mezzioApplication);

$mezzioApplication->run();

