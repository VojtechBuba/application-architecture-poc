<?php declare(strict_types = 1);


namespace Pd\Storage\Domain;

use Pd\Storage\Domain\Exception\UnsupportedExtensionValueException;
use function in_array;

class Extension
{

	private const SUPPORTED_VALUES = [
		'jpg',
		'png',
		'jpeg',
		'pdf'
	];

	private string $value;

	public function __construct(
		string $value
	)
	{
		if ( ! in_array($value, self::SUPPORTED_VALUES)) {
			throw new UnsupportedExtensionValueException($value);
		}

		$this->value = $value;
	}


	public function getValue(): string
	{
		return $this->value;
	}
}
