<?php declare(strict_types=1);

namespace App\Model\DTO;

final class EventQuest
{
    public int $number;
    public EventQuestTask $firstTask;
    public ?EventQuestTask $firstAlternateTask = null;
    public ?EventQuestTask $secondTask = null;
    public ?EventQuestTask $secondAlternateTask = null;
}
