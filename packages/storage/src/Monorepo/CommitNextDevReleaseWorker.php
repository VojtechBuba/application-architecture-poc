<?php

declare (strict_types=1);
namespace Pd\Storage\Monorepo;

use PharIo\Version\Version;
use Symplify\MonorepoBuilder\Release\Contract\ReleaseWorker\ReleaseWorkerInterface;
use Symplify\MonorepoBuilder\Release\Process\ProcessRunner;
use Symplify\MonorepoBuilder\Utils\VersionUtils;
use Symplify\MonorepoBuilder\ValueObject\Option;
use MonorepoBuilder20220521\Symplify\PackageBuilder\Parameter\ParameterProvider;
final class CommitNextDevReleaseWorker implements \Symplify\MonorepoBuilder\Release\Contract\ReleaseWorker\ReleaseWorkerInterface
{
	/**
     * @var \Symplify\MonorepoBuilder\Release\Process\ProcessRunner
     */
    private $processRunner;
    /**
     * @var \Symplify\MonorepoBuilder\Utils\VersionUtils
     */
    private $versionUtils;
    public function __construct(\Symplify\MonorepoBuilder\Release\Process\ProcessRunner $processRunner, \Symplify\MonorepoBuilder\Utils\VersionUtils $versionUtils, \MonorepoBuilder20220521\Symplify\PackageBuilder\Parameter\ParameterProvider $parameterProvider)
    {
        $this->processRunner = $processRunner;
        $this->versionUtils = $versionUtils;
    }
    public function work(\PharIo\Version\Version $version) : void
    {
        $versionInString = $this->getVersionDev($version);
        $gitAddCommitCommand = \sprintf('git add . && git commit --allow-empty -m "open %s"', $versionInString);
        $this->processRunner->run($gitAddCommitCommand);
    }
    public function getDescription(\PharIo\Version\Version $version) : string
    {
        $versionInString = $this->getVersionDev($version);
        return \sprintf('Open "%s"', $versionInString);
    }
    private function getVersionDev(\PharIo\Version\Version $version) : string
    {
        return $this->versionUtils->getNextAliasFormat($version);
    }
}
