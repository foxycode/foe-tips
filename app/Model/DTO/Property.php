<?php declare(strict_types=1);

namespace App\Model\DTO;

use Nette\Utils\Strings;

final class Property
{
    public string $name;

    public static function fromImageName(string $imageName): self
    {
        return new self(Strings::replace($imageName, '~^([^\-]+)\-[0-9a-z]+\.png$~', '\\1'));
    }

    public function __construct(string $name)
    {
        $this->name = $name;
    }
}
