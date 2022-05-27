<?php declare(strict_types = 1);


namespace Pd\Storage\Domain;

class TenantId
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
}
