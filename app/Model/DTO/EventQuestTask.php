<?php declare(strict_types=1);

namespace App\Model\DTO;

final class EventQuestTask
{
    public const PAY = 'pay';
    public const SPEND = 'spend';
    public const BUILD = 'build';
    public const DEFEAT = 'defeat';

    public string $text;
    public string $type;
    public ?int $minAmount = null;
    public ?int $maxAmount = null;
    public ?string $what = null;
}
