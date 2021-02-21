<?php declare(strict_types=1);

namespace App\Model\DTO;

final class BuildingSize
{
    public int $width;
    public int $height;
    public int $area;

    public static function fromString(string $size): self
    {
        [$width, $height] = explode('x', $size);
        return new self((int) $width, (int) $height);
    }

    public function __construct(int $width, int $height)
    {
        $this->width = $width;
        $this->height = $height;
        $this->area = $width * $height;
    }
}
