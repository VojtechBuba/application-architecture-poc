<?php declare(strict_types = 1);


namespace Pd\Storage\Infrastructure\Persistence\Doctrine\Type;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;
use Doctrine\DBAL\Types\Types;
use Pd\Storage\Domain\Measurement\Byte;
use Pd\Storage\Infrastructure\Persistence\Doctrine\Exception\InvalidMappingTypeException;
use function is_int;

class ByteType extends Type
{

	public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform)
	{
		return Types::INTEGER;
	}


	public function convertToDatabaseValue($value, AbstractPlatform $platform)
	{
		if ( ! $value instanceof Byte) {
			throw new InvalidMappingTypeException();
		}

		return $value->getValue();
	}


	public function convertToPHPValue($value, AbstractPlatform $platform)
	{
		if ( ! is_int($value)) {
			throw new InvalidMappingTypeException();
		}

		return new Byte($value);
	}


	public function getName(): string
	{
		return 'storage.byte';
	}
}
