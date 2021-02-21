<?php declare(strict_types=1);

namespace App\Model\Parsers;

use App\Model\DTO\EventQuest;
use App\Model\DTO\EventQuestTask;
use Nette\Utils\Strings;

final class EventQuestParser
{
    public static function parse(array $quest): EventQuest
    {
        $eq = new EventQuest;
        $eq->number = self::parseNumber($quest['number']);

//        $text = Strings::replace($text, "~\n===== \\| Condition2=(.+) =====~", '\\1');

        $firstTasks = Strings::split($quest['tasks'][0], '~ OR ~');
        $eq->firstTask = self::parseTask($firstTasks[0]);
        if (isset($firstTasks[1])) {
            $eq->firstAlternateTask = self::parseTask($firstTasks[1]);
        }

        if (isset($quest['tasks'][1])) {
            $secondTasks = Strings::split($quest['tasks'][1], '~ OR ~');
            $eq->secondTask = self::parseTask($secondTasks[0]);
            if (isset($secondTasks[1])) {
                $eq->firstAlternateTask = self::parseTask($secondTasks[1]);
            }
        }

        return $eq;
    }

    private static function parseNumber(string $number): int
    {
        return (int) Strings::replace($number, '~Quest ([0-9]+):~', '\\1');
    }

    private static function parseTask(string $text): EventQuestTask
    {
        $text = self::normalize($text);

        $task = new EventQuestTask;
        $task->text = $text;

        // Pay some (2,000 - 2,416,000) coins
        if ($matches = Strings::match($text, '~Pay some \\(([0-9,]+) - ([0-9,]+)\\) (coins|supplies|goods from your age|goods from the previous age)~')) {
            $task->type = EventQuestTask::PAY;
            $task->minAmount = (int) Strings::replace($matches[1], '~,~', '');
            $task->maxAmount = (int) Strings::replace($matches[2], '~,~', '');
            $task->what = $matches[3];
        }

        // Spend some (7 - 27) Forge Points
        if ($matches = Strings::match($text, '~Spend some \\(([0-9,]+) - ([0-9,]+)\\) (.+)~')) {
            $task->type = EventQuestTask::SPEND;
            $task->minAmount = (int) Strings::replace($matches[1], '~,~', '');
            $task->maxAmount = (int) Strings::replace($matches[2], '~,~', '');
            $task->what = $matches[3];
        }

        // Build 5 decorations
        if ($matches = Strings::match($text, '~Build ([0-9]+) (decorations?|culture buildings?|residential buildings?|production buildings?|goods buildings?)(?: (from your age|from the previous age))?~')) {
            $task->type = EventQuestTask::SPEND;
            $task->minAmount = (int) $matches[1];
            $task->what = $matches[2];
        }

        // Defeat this very small army
        if ($matches = Strings::match($text, '~Defeat this (very small|small|medium|large|very large) army~')) {
            $task->type = EventQuestTask::SPEND;
            $task->what = $matches[1];
        }

        // Gather some (24 - 264) goods, e.g. From goods buildings or by trading
        // Gather some (1,500 - 1,650,000) coins
        // Gain some (230 - 30,000) happiness

        // In a production building, finish a 5-minute production some (4 - 24) times
        // Finish a 8-hour production some (2 - 14) times in a production building
        // Finish 18 productions in production buildings from your age

        // Visits 20 Friends Taverns

        // Collect 3 incidents

        // Activate 2 boosts in the Friends Tavern
        // Spend 400 Tavern Silver in the Friends Tavern

        // Acquire some (1 - 2) sectors
        // Infiltrate 4 sectors

        // Exchange 4 items in the Antiques Dealer Building

        // Win some (2 - 4) battles without losing
        // Defeat some (15 - 68) units

        // Solve this simple negotiation

        // Donate some (40 -340) goods to the guild treasury

        // Buy 5 Forge Points

        // Motivate or polish 50 buildings of other players

        // Make people enthusiastic

        return $task;
    }

    private static function normalize(string $text): string
    {
        $text = Strings::replace($text, '~\\(([0-9,]+) - ([0-9,]+)\\[[A-Z]+\\]\\)~', '(\\1 - \\2)');
        $text = Strings::replace($text, '~\\(([0-9,]+) - ([0-9,]+) ~', '(\\1 - \\2) ');
        $text = Strings::replace($text, '~selected\\[(1|2)\\] goods~', 'goods');
//        $text = Strings::replace($text, '~building2~', 'buildings');

        return $text;
    }
}
