<?php declare(strict_types=1);

namespace App\Model\Parsers;

use Atrox\Matcher;

final class EventPageParser
{
    public static function parse(string $page): array
    {
        $m = Matcher::single('//div[@class="WikiaPageContentWrapper"]', [
            'name' => './/h1[@id="firstHeading"]',
            'mainQuestLine' => Matcher::multi('.//div[@id="mw-customcollapsible-MainQL"]/div[@class="Quest"]', [
                'number' => './/u/b',
                'tasks' => Matcher::multi('.//ul/font[@color="#98B450"]'),
            ]),
            'dailyQuestLine' => Matcher::multi('.//div[@id="mw-customcollapsible-DailyQL"]/div[@class="Quest"]', [
                'number' => './/u/b',
                'tasks' => Matcher::multi('.//ul/font[@color="#98B450"]'),
            ]),
            'townTasks' => Matcher::multi('.//div[@id="mw-customcollapsible-Tasks"]/table/tbody/tr[position()>1]', [
                'number' => './/td[1]',
                'firstTown' => './/td[2]',
                'secondTown' => './/td[3]',
                'thirdTown' => './/td[4]',
            ])
        ])->fromHtml();

        $matches = $m($page);

        foreach ($matches['mainQuestLine'] as $k => $quest) {
            $matches['mainQuestLine'][$k] = EventQuestParser::parse($quest);
        }

        foreach ($matches['dailyQuestLine'] as $k => $quest) {
            $matches['dailyQuestLine'][$k] = EventQuestParser::parse($quest);
        }

        return $matches;
    }
}
