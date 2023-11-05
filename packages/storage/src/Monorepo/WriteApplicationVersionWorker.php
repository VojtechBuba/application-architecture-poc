<?php

declare (strict_types=1);
namespace Pd\Storage\Monorepo;

use PharIo\Version\Version;
use Symplify\MonorepoBuilder\Release\Contract\ReleaseWorker\ReleaseWorkerInterface;
use Symplify\MonorepoBuilder\Release\Process\ProcessRunner;
use Symplify\MonorepoBuilder\Utils\VersionUtils;
use Symplify\MonorepoBuilder\ValueObject\Option;
use MonorepoBuilder20220521\Symplify\PackageBuilder\Parameter\ParameterProvider;
final class WriteApplicationVersionWorker implements \Symplify\MonorepoBuilder\Release\Contract\ReleaseWorker\ReleaseWorkerInterface
{
	/**
     * @var \Symplify\MonorepoBuilder\Release\Process\ProcessRunner
     */
    private $processRunner;
    /**
     * @var \Symplify\MonorepoBuilder\Utils\VersionUtils
     */
    private $versionUtils;
    public function __construct(\Symplify\MonorepoBuilder\Release\Process\ProcessRunner $processRunner, \Symplify\MonorepoBuilder\Utils\VersionUtils $versionUtils)
    {
        $this->processRunner = $processRunner;
        $this->versionUtils = $versionUtils;
    }
    public function work(\PharIo\Version\Version $version) : void
    {
        $gitAddCommitCommand = \sprintf('echo %s > app_version', $version->getOriginalString());
        $this->processRunner->run($gitAddCommitCommand);
    }
    public function getDescription(\PharIo\Version\Version $version) : string
    {
        return \sprintf('Write current version "%s" to app_version file.', $version->getOriginalString());
    }
}
