<?php declare(strict_types = 1);

namespace Pd\Storage\Tests\Domain;

use Pd\Storage\Domain\Exception\UnexpectedFileNameCharacters;
use Pd\Storage\Domain\FileSystem\FileName;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

class FileNameTest extends TestCase
{

	public function testValidFileName(): void
	{
		$fileName = new FileName('some-image-name.png');

		Assert::assertSame('some-image-name.png', $fileName->getValue());
	}


	public function testInvalidFileName(): void
	{
		$this->expectException(UnexpectedFileNameCharacters::class);

		new FileName('data/some-image-name.png');
	}
}
