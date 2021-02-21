<?php declare(strict_types=1);

namespace App\Forms;

use Nette\Application\UI\Form;

final class BuildingAddFormFactory
{
    public function create(): Form
    {
        $form = new Form;

        $form->addText('wikiUrlCs', 'Odkaz na českou Wiki')
            ->setRequired('Musíte zadat url');

        //$form->addText('wikiUrlEn', 'Odkaz na anglickou Wiki');

        $form->addSubmit('add', 'Přidat');

        return $form;
    }
}
