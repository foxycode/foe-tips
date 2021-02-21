<?php declare(strict_types=1);

namespace App\Forms;

use App\Model\Facades\AgeFacade;
use Nette\Application\UI\Form;
use Nette\Http\Session;
use Nette\Http\SessionSection;
use Nette\Utils\ArrayHash;

final class BuildingCompareFilterFormFactory
{
    private AgeFacade $ageFacade;
    private SessionSection $buildingCompareFilterSession;

    public function __construct(AgeFacade $ageFacade, Session $session)
    {
        $this->ageFacade = $ageFacade;
        $this->buildingCompareFilterSession = $session->getSection('buildingCompareFilter');
    }

    public function getAge(): int
    {
        return $this->buildingCompareFilterSession->age ?? 1;
    }

    public function create(): Form
    {
        $form = new Form;

        $form->setMethod('get');

        $ages = $this->ageFacade->findForSelect();
        $form->addSelect('age', 'Věk', $ages)
            ->setDefaultValue($this->buildingCompareFilterSession->age ?? 1);

        $form->addSubmit('filter', 'Filtrovat');

        $form->onSuccess[] = function (Form $form, ArrayHash $values) {
            $this->buildingCompareFilterSession->age = $values->age;
        };

        return $form;
    }
}
