<?php declare(strict_types = 1);


namespace Pd\Storage\Infrastructure\Persistence\Doctrine\Type;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;
use Pd\Storage\Domain\Extension;
use Pd\Storage\Infrastructure\Persistence\Doctrine\Exception\InvalidMappingTypeException;

class ExtensionType extends Type
{

	public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform)
	{
		return 'VARCHAR(255)';
	}


	public function convertToDatabaseValue($value, AbstractPlatform $platform)
	{
		if ( ! $value instanceof Extension) {
			throw new InvalidMappingTypeException();
		}

		return $value->getValue();
	}


	public function convertToPHPValue($value, AbstractPlatform $platform)
	{
		if ( ! is_string($value)) {
			throw new InvalidMappingTypeException();
		}

		return new Extension($value);
	}


	public function getName(): string
	{
		return 'storage.extension';
	}
}
