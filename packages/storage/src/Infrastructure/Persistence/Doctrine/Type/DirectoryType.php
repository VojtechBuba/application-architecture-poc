<?php declare(strict_types = 1);


namespace Pd\Storage\Infrastructure\Persistence\Doctrine\Type;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;
use Pd\Storage\Domain\FileSystem\Directory;
use Pd\Storage\Infrastructure\Persistence\Doctrine\Exception\InvalidMappingTypeException;
use function is_string;

class DirectoryType extends Type
{

	public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform)
	{
		return 'VARCHAR(255)';
	}


	public function convertToDatabaseValue($value, AbstractPlatform $platform)
	{
		if ( ! $value instanceof Directory) {
			throw new InvalidMappingTypeException();
		}

		return $value->getPath();
	}


	public function convertToPHPValue($value, AbstractPlatform $platform)
	{
		if ( ! is_string($value)) {
			throw new InvalidMappingTypeException();
		}

		return new Directory($value);
	}


	public function getName(): string
	{
		return 'storage.directory';
	}
}
