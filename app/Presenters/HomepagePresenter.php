<?php declare(strict_types=1);

namespace App\Presenters;

use Nette\Application\UI\Presenter;

final class HomepagePresenter extends Presenter
{
    public function __construct()
    {
        parent::__construct();
    }

    public function actionDefault(): void
    {
    }
}