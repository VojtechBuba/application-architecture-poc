<?php declare(strict_types = 1);


namespace Pd\Storage\Domain;

class FileId
{

	private string $value;

	public function __construct(
		string $value
	)
	{
		$this->value = $value;
	}


	public function getValue(): string
	{
		return $this->value;
	}


	public function equals(self $to): bool
	{
		return $this->value === $to->getValue();
	}


	public function __toString()
	{
		return $this->getValue();
	}
}
