<?php declare(strict_types = 1);

use Pd\Storage\Monorepo\CommitNextDevReleaseWorker;
use Pd\Storage\Monorepo\CommitPrepareReleaseWorker;
use Pd\Storage\Monorepo\CreatePrepareReleaseBranchWorker;
use Pd\Storage\Monorepo\PushPrepareReleaseBranchWorker;
use Pd\Storage\Monorepo\WriteApplicationVersionWorker;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symplify\ComposerJsonManipulator\ValueObject\ComposerJsonSection;
use Symplify\MonorepoBuilder\ValueObject\Option;
use Symplify\MonorepoBuilder\Release\ReleaseWorker\AddTagToChangelogReleaseWorker;
use Symplify\MonorepoBuilder\Release\ReleaseWorker\PushNextDevReleaseWorker;
use Symplify\MonorepoBuilder\Release\ReleaseWorker\PushTagReleaseWorker;
use Symplify\MonorepoBuilder\Release\ReleaseWorker\SetCurrentMutualDependenciesReleaseWorker;
use Symplify\MonorepoBuilder\Release\ReleaseWorker\SetNextMutualDependenciesReleaseWorker;
use Symplify\MonorepoBuilder\Release\ReleaseWorker\TagVersionReleaseWorker;
use Symplify\MonorepoBuilder\Release\ReleaseWorker\UpdateBranchAliasReleaseWorker;
use Symplify\MonorepoBuilder\Release\ReleaseWorker\UpdateReplaceReleaseWorker;

return static function (ContainerConfigurator $containerConfigurator): void {
    $parameters = $containerConfigurator->parameters();

	// where are the packages located?
	$parameters->set(Option::PACKAGE_DIRECTORIES, [
		__DIR__ . '/packages',
	]);

	$parameters->set(Option::DEFAULT_BRANCH_NAME, "main");

    // for "merge" command
    $parameters->set(Option::DATA_TO_APPEND, [
        ComposerJsonSection::REQUIRE_DEV => [
            'phpunit/phpunit' => '^9.5',
        ],
    ]);
	$parameters->set('enable_default_release_workers', false);

	$services = $containerConfigurator->services();

	# release workers - in order to execute
	$services->set(CreatePrepareReleaseBranchWorker::class);
	$services->set(UpdateReplaceReleaseWorker::class);
	$services->set(SetCurrentMutualDependenciesReleaseWorker::class);
	$services->set(WriteApplicationVersionWorker::class);
	$services->set(CommitPrepareReleaseWorker::class);
	$services->set(SetNextMutualDependenciesReleaseWorker::class);
	$services->set(UpdateBranchAliasReleaseWorker::class);
	$services->set(CommitNextDevReleaseWorker::class);
	$services->set(PushPrepareReleaseBranchWorker::class);
};
