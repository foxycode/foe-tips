<?php declare(strict_types=1);

namespace App\Presenters;

use App\Forms\BuildingAddFormFactory;
use App\Model\Facades\BuildingAddFacade;
use Nette\Application\UI\Form;
use Nette\Application\UI\Presenter;
use Nette\Utils\ArrayHash;

final class BuildingAddPresenter extends Presenter
{
    private BuildingAddFacade $buildingAddFacade;
    private BuildingAddFormFactory $buildingAddFormFactory;

    public function __construct(BuildingAddFacade $buildingAddFacade, BuildingAddFormFactory $buildingAddFormFactory)
    {
        parent::__construct();
        $this->buildingAddFacade = $buildingAddFacade;
        $this->buildingAddFormFactory = $buildingAddFormFactory;
    }

    protected function createComponentBuildingAddForm(): Form
    {
        $form = $this->buildingAddFormFactory->create();

        $form->onSuccess[] = function (Form $form, ArrayHash $values) {
            $this->buildingAddFacade->addFromCzechWiki($values->wikiUrlCs);
            $this->flashMessage('Budova byla přidána', 'alert-success');
            $this->redirect('Homepage:');
        };

        return $form;
    }
}
