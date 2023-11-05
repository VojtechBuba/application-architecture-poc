<?php

declare (strict_types=1);
namespace Pd\Storage\Monorepo;

use PharIo\Version\Version;
use Symplify\MonorepoBuilder\Release\Contract\ReleaseWorker\ReleaseWorkerInterface;
use Symplify\MonorepoBuilder\Release\Process\ProcessRunner;
use Symplify\MonorepoBuilder\ValueObject\Option;
use MonorepoBuilder20220521\Symplify\PackageBuilder\Parameter\ParameterProvider;
use Throwable;
final class CommitPrepareReleaseWorker implements \Symplify\MonorepoBuilder\Release\Contract\ReleaseWorker\ReleaseWorkerInterface
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
        try {
            $gitAddCommitCommand = 'git add . && git commit -m "prepare release"';
            $this->processRunner->run($gitAddCommitCommand);
        } catch (\Throwable $exception) {
            // nothing to commit
        }
    }

    public function getDescription(\PharIo\Version\Version $version) : string
    {
        return 'Commit prepare release files"';
    }
}
