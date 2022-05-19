<?php declare(strict_types = 1);

namespace Pd\StorageAdmin\Presenters;

use Nette;
use Pd\StorageSDK\Resources\Storage\GetStorageFacade;

final class HomepagePresenter extends Nette\Application\UI\Presenter
{

	private GetStorageFacade $getStorageFacade;


	public function __construct(
		GetStorageFacade $getStorageFacade
	)
	{
		$this->getStorageFacade = $getStorageFacade;
	}


	public function renderDefault(): void
	{
		$this->getTemplate()->add(
			'data',
			$this->getStorageFacade->execute()
		);
	}
}
