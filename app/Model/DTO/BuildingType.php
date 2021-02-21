<?php declare(strict_types=1);

namespace App\Model\DTO;

final class BuildingType
{
    public const CULTURAL = 'Kulturní budovy';
    public const DECORATIONS = 'Dekorace';
    public const GOODS = 'Továrny';
    public const GREAT = 'Velkolepé budovy';
    public const MILITARY = 'Vojenské budovy';
    public const PRODUCTION = 'Dílny';
    public const RESIDENTIAL = 'Obytné budovy';
    public const ROADS = 'Cesty';
    public const SPECIAL = 'Speciální budovy';

    public string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }
}
