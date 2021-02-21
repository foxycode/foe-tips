<?php declare(strict_types=1);

namespace App\Model\Parsers;

use App\Model\DTO\Building;
use Atrox\Matcher;

final class BuildingPageParser
{
    public static function parse(string $page): Building
    {
        $m = Matcher::single('//div[@class="tbbox-pagecontent"]', [
            'name' => './/h1[@class="firstHeading"]',
            'image' => './/div[@id="bodyContent"]/div[@id="mw-content-text"]/div[@class="mw-parser-output"]/table[1]/tbody/tr[1]/td/img/@src',
            'type' => './/div[@id="bodyContent"]/div[@id="mw-content-text"]/div[@class="mw-parser-output"]/table[1]/tbody/tr[4]/td[2]',
            'size' => './/div[@id="bodyContent"]/div[@id="mw-content-text"]/div[@class="mw-parser-output"]/table[1]/tbody/tr[6]/td[2]',
            'propertyHeader' => Matcher::multi('.//div[@id="bodyContent"]/div[@id="mw-content-text"]/div[@class="mw-parser-output"]/table[2]/tbody/tr[2]/th/div/img/@alt'),
            'ages' => Matcher::multi('.//div[@id="bodyContent"]/div[@id="mw-content-text"]/div[@class="mw-parser-output"]/table[2]/tbody/tr[position()>3]', [
                Matcher::multi('.//td'),
            ]),
        ])->fromHtml();

        $matches = $m($page);

        $building = Building::fromMatcher($matches);

        return $building;
    }
}
