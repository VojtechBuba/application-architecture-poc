<?php declare(strict_types = 1);


namespace Pd\Storage\Infrastructure\Persistence\Doctrine\Type;


use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;
use Nette\Utils\Json;
use Pd\Storage\Domain\FileSystem\Path;
use Pd\Storage\Infrastructure\Persistence\Doctrine\Exception\InvalidMappingTypeException;
use Pd\Storage\Infrastructure\Persistence\Doctrine\Serialization\SerializedPath;
use function is_string;

class PathType extends Type
{
	public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform)
	{
		if ($platform->hasNativeJsonType()) {
			return \Doctrine\DBAL\Types\Types::JSON;
		}

		return \Doctrine\DBAL\Types\Types::TEXT;
	}


	public function convertToPHPValue($value, AbstractPlatform $platform)
	{
		if ( ! is_string($value)) {
			throw new InvalidMappingTypeException();
		}

		$data = \Nette\Utils\Json::decode($value, \Nette\Utils\Json::FORCE_ARRAY);

		return SerializedPath::deserialize($data);
	}


	public function convertToDatabaseValue($value, AbstractPlatform $platform)
	{
		if ( ! $value instanceof Path) {
			throw new InvalidMappingTypeException();
		}

		return Json::encode(new SerializedPath($value));
	}


	public function getName(): string
	{
		return 'storage.path';
	}
}
