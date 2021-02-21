<?php declare(strict_types=1);

namespace App\Presenters;

use App\Model\Parsers\EventPageParser;
use Nette;

final class EventPresenter extends Nette\Application\UI\Presenter
{
    public function actionDefault(): void
    {
        $page = file_get_contents('https://forgeofempires.fandom.com/wiki/2021_St_Patrick%27s_Day_Event');
        $event = EventPageParser::parse($page);
        dumpe($event);

        $this->template->event = $event;
    }
}
