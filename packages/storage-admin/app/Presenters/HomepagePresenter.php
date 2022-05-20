<?php declare(strict_types = 1);

namespace Pd\StorageAdmin\Presenters;

use Nette;
use Pd\StorageSDK\Resources\Files\ListCollection\ListFilesFacade;

final class HomepagePresenter extends Nette\Application\UI\Presenter
{


	private ListFilesFacade $listFilesFacade;


	public function __construct(
		ListFilesFacade $listFilesFacade
	)
	{

		$this->listFilesFacade = $listFilesFacade;
	}


	public function renderDefault(): void
	{
		$this->getTemplate()->add(
			'data',
			$this->listFilesFacade->listFiles()
		);
	}
}
