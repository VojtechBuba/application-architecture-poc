<?php declare(strict_types = 1);

namespace Pd\StorageAdmin\Presenters;

use Nette;
use Pd\StorageSDK\Resources\Files\GetFileFacade;

final class HomepagePresenter extends Nette\Application\UI\Presenter
{

	private GetFileFacade $getFileFacade;


	public function __construct(
		GetFileFacade $getFileFacade,
		Nette\Application\LinkGenerator $linkGenerator
	)
	{
		$this->getFileFacade = $getFileFacade;
	}
}
