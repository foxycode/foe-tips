<?php declare(strict_types=1);

namespace App\Model\DTO;

use Nette\Utils\Strings;

final class PropertyValue
{
    public int $value;
    public ?string $unit;

    public static function fromString(string $value): self
    {
        $value = Strings::replace($value, '~\s~', '');
        if (Strings::contains($value, '%')) {
            $unit = '%';
        }

        return new self((int) $value, $unit ?? null);
    }

    public function __construct(int $value, ?string $unit = null)
    {
        $this->value = $value;
        $this->unit = $unit;
    }
}
