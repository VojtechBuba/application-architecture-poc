<?php

declare (strict_types=1);
namespace Pd\Storage\Monorepo;

use PharIo\Version\Version;
use Symplify\MonorepoBuilder\Release\Contract\ReleaseWorker\ReleaseWorkerInterface;
use Symplify\MonorepoBuilder\Release\Process\ProcessRunner;
use Symplify\MonorepoBuilder\ValueObject\Option;
use MonorepoBuilder20220521\Symplify\PackageBuilder\Parameter\ParameterProvider;
use Throwable;
final class PushPrepareReleaseBranchWorker implements \Symplify\MonorepoBuilder\Release\Contract\ReleaseWorker\ReleaseWorkerInterface
{
    /**
     * @var \Symplify\MonorepoBuilder\Release\Process\ProcessRunner
     */
    private $processRunner;
    public function __construct(\Symplify\MonorepoBuilder\Release\Process\ProcessRunner $processRunner, \MonorepoBuilder20220521\Symplify\PackageBuilder\Parameter\ParameterProvider $parameterProvider)
    {
        $this->processRunner = $processRunner;
    }
    public function work(\PharIo\Version\Version $version) : void
    {
		$branchName = sprintf("prepare-release-%s", $version->getOriginalString());

        try {
            $gitAddCommitCommand = \sprintf('git push --set-upstream origin "%s"', $branchName);
            $this->processRunner->run($gitAddCommitCommand);
        } catch (\Throwable $exception) {
            // nothing to commit
        }
    }
    public function getDescription(\PharIo\Version\Version $version) : string
    {
        return \sprintf('Push prepare release branch for version "%s" to remote.', $version->getOriginalString());
    }
}
