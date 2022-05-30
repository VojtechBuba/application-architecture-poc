<?php declare(strict_types = 1);

namespace Pd\Storage\Domain\FileSystem;

use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

class DirectoryTest extends TestCase
{

	public function testLevelDown(): void
	{
		$root = new Directory('www/files/storage-data/');

		$result = $root->levelDown('some-tenant-folder');

		Assert::assertSame('www/files/storage-data/some-tenant-folder', $result->getPath());
	}


	public function testMoveTo(): void
	{
		$root = new Directory('www/files/storage-data/');
		$folder = new Directory('some-tenant-folder');

		$result = $folder->moveTo($root);

		Assert::assertSame('www/files/storage-data/some-tenant-folder', $result->getPath());
	}
}
