<?php declare(strict_types=1);

namespace App\Model\Translators;

use Nette\Utils\Strings;

final class EventQuestTranslator
{
    public static function translate(array $event): array
    {
        $event['name'] = self::translateName($event['name']);

        foreach ($event['mainQuestLine'] as $k => $quest) {
            $event['mainQuestLine'][$k] = self::translateQuest($quest);
        }

        foreach ($event['dailyQuestLine'] as $k => $quest) {
            $event['dailyQuestLine'][$k] = self::translateQuest($quest);
        }

        return $event;
    }

    private static function translateName(string $name): string
    {
        $matches = Strings::match($name, '~([0-9]{4}) (.+) Event~');
        if (count($matches) !== 3) {
            return $name;
        }

        if ($matches[2] === 'St Patrick\'s Day') {
            $matches[2] = 'Den Svatého Patrika';
        }

        return "{$matches[2]} {$matches[1]}";
    }

    private static function translateQuest(array $quest): array
    {
        foreach ($quest['tasks'] as $k => $task) {
            $quest['tasks'][$k] = self::translateTask($task);
        }

        return $quest;
    }

    private static function translateTask(string $task): string
    {
        $task = Strings::replace($task, '~ OR ~', ' NEBO ');

//        $task = Strings::replace($task, '~Pay some~', 'Zaplať');
//        $task = Strings::replace($task, '~Spend some~', 'Utrať');
//        $task = Strings::replace($task, '~Spend~', 'Utrať');
//        $task = Strings::replace($task, '~Buy~', 'Kup');
//        $task = Strings::replace($task, '~Collect~', 'Sesbírej');
//        $task = Strings::replace($task, '~Exchange~', 'Vyměň');
//        $task = Strings::replace($task, '~Gain some~', 'Získej');
//        $task = Strings::replace($task, '~Activate~', 'Aktivuj');
//        $task = Strings::replace($task, '~Win some~', 'Vyhraj');
//        $task = Strings::replace($task, '~Infiltrate~', 'Pronikni do');
//        $task = Strings::replace($task, '~Defeat some~', 'Poraz');
//        $task = Strings::replace($task, '~Visit~', 'Navštiv');
//        $task = Strings::replace($task, '~Gather some~', 'Shromáždi');
//        $task = Strings::replace($task, '~Donate some~', 'Daruj');
//        $task = Strings::replace($task, '~Build~', 'Postav');

//        $task = Strings::replace($task, '~[,]* e.g. [Ff]rom goods production buildings or by trading~', '');
//        $task = Strings::replace($task, '~selected[^ ]*~', 'vybrané');

//        $task = Strings::replace($task, '~In a production building[,]*~', 'V dílně');
//        $task = Strings::replace($task, '~in a production building~', 'v dílně');
//        $task = Strings::replace($task, '~decorations~', 'dekorací');
//        $task = Strings::replace($task, '~from your age~', 'ze své éry');
//        $task = Strings::replace($task, '~of your age~', 'ze své éry');
//        $task = Strings::replace($task, '~from the previous age~', 'z předchozí éry');
//        $task = Strings::replace($task, '~culture building[^ ]*~', 'kulturní budovy');
//        $task = Strings::replace($task, '~residential building[^ ]*~', 'obytné budovy');
//        $task = Strings::replace($task, '~production building[^ ]*~', 'dílny');
//        $task = Strings::replace($task, '~goods building[^ ]*~', 'továrny');

//        $task = Strings::replace($task, '~coins~', 'mincí');
//        $task = Strings::replace($task, '~supplies~', 'zásob');
//        $task = Strings::replace($task, '~goods~', 'zboží');
//        $task = Strings::replace($task, '~Forge Points~', 'body výzkumu');
//        $task = Strings::replace($task, '~incidents~', 'příhody');
//        $task = Strings::replace($task, '~items in the Antiques Dealer Building~', 'předmětů ve starožitnictví');
//        $task = Strings::replace($task, '~happiness~', 'spokojenost');
//        $task = Strings::replace($task, '~boosts in the Friends Tavern~', 'navýšení v krčmě');
//        $task = Strings::replace($task, '~battles~', 'bitev');
//        $task = Strings::replace($task, '~without losing~', 'bez prohry');
//        $task = Strings::replace($task, '~Tavern Silver in the Friends Tavern~', 'stříbrných v krčmě');
//        $task = Strings::replace($task, '~sectors~', 'sektorů');
//        $task = Strings::replace($task, '~units~', 'jednotek');
//        $task = Strings::replace($task, '~to the guild treasury~', 'do pokladny cechu');

//        $task = Strings::replace($task, '~Finish a~', 'Dokonči');
//        $task = Strings::replace($task, '~finish a~', 'dokonči');
//        $task = Strings::replace($task, '~5-minute~', '5m');
//        $task = Strings::replace($task, '~15-minute~', '15m');
//        $task = Strings::replace($task, '~1-hour~', '1h');
//        $task = Strings::replace($task, '~4-hour~', '4h');
//        $task = Strings::replace($task, '~8-hour~', '8h');
//        $task = Strings::replace($task, '~production some~', 'produkci');
//        $task = Strings::replace($task, '~ times~', '');

//        $task = Strings::replace($task, '~Defeat this~', 'Poraz tuto');
//        $task = Strings::replace($task, '~very small army~', 'velmi malou armádu');
//        $task = Strings::replace($task, '~small army~', 'malou armádu');
//        $task = Strings::replace($task, '~medium army~', 'střední armádu');
//        $task = Strings::replace($task, '~large army~', 'velkou armádu');

//        $task = Strings::replace($task, '~Solve this~', 'Vyřeš toto');
//        $task = Strings::replace($task, '~simple negotiation~', 'jednoduché vyjednávání');
//        $task = Strings::replace($task, '~moderate negotiation~', 'středně těžké vyjednávání');
//        $task = Strings::replace($task, '~complex negotiation~', 'složité vyjednávání');

//        $task = Strings::replace($task, '~Visits~', 'Navštiv');
//        $task = Strings::replace($task, '~Friends Taverns~', 'krčem');

//        $task = Strings::replace($task, '~Motivate or polish~', 'Motivuj nebo zušlechti');
//        $task = Strings::replace($task, '~buildings of other players~', 'budov');

//        $task = Strings::replace($task, '~Make people enthusiastic~', 'Povzbuď nadšení lidí');
//        $task = Strings::replace($task, '~Have the first difficulty in the Guild Expedition solved~', 'Vyřeš první úroveň obtížnosti v cechovní expedici');

        return $task;
    }
}
