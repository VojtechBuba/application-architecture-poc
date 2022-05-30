<?php declare(strict_types = 1);

namespace Pd\StorageAdmin\Presenters;

use Nette;
use Pd\StorageSDK\Resources\Files\ListCollection\ListFilesFacade;
use Pd\StorageSDK\Resources\Files\UploadFile\UploadedFile;
use Pd\StorageSDK\Resources\Files\UploadFile\UploadFileFacade;

final class HomepagePresenter extends Nette\Application\UI\Presenter
{


	private ListFilesFacade $listFilesFacade;

	private UploadFileFacade $uploadFileFacade;


	public function __construct(
		ListFilesFacade $listFilesFacade,
		UploadFileFacade $uploadFileFacade
	)
	{
		$this->listFilesFacade = $listFilesFacade;
		$this->uploadFileFacade = $uploadFileFacade;
	}


	public function renderDefault(): void
	{
		$this->getTemplate()->add(
			'data',
			$this->listFilesFacade->listFiles()
		);
	}


	public function createComponentUploadForm(): Nette\Application\UI\Form
	{
		$form = new Nette\Application\UI\Form();
		$form
			->addSelect('tenant', 'Tenant', [
				'pecka' => 'PeckaDesign',
				'other' => 'Other',
			])
			->setRequired('Musíte vybrat účet pod který se soubor nahraje.')
		;
		$form
			->addUpload('file', 'Subor k nahráni do uložiště')
			->setRequired('Musíte vybrat soubor.')
		;
		$form->addSubmit('submit', 'Nahrát');

		$form->onSuccess[] = function (Nette\Application\UI\Form $form) {
			$values = $form->getValues();

			/** @var Nette\Http\FileUpload $file */
			$file = $values['file'];

			$this->uploadFileFacade->upload(
				$values['tenant'],
				new UploadedFile(
					$file->getSanitizedName(),
					$file->getTemporaryFile()
				)
			);
		};

		return $form;
	}
}
