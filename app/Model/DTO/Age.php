<?php declare(strict_types=1);

namespace App\Model\DTO;

final class Age
{
    public const NoAge = 'Žádný věk';
    public const StoneAge = 'Doba kamenná';
    public const BronzeAge = 'Doba bronzová';
    public const IronAge = 'Doba železná';
    public const EarlyMiddleAges = 'Raný středověk';
    public const HighMiddleAges = 'Vrcholný středověk';
    public const LateMiddleAges = 'Pozdní středověk';
    public const ColonialAge = 'Koloniální doba';
    public const IndustrialAge = 'Průmyslový věk';
    public const ProgressiveEra = 'Doba Pokroku';
    public const ModernEra = 'Moderní doba';
    public const PostmodernEra = 'Postmoderní doba';
    public const ContemporaryEra = 'Současná éra';
    public const Tomorrow = 'Svět zítřka';
    public const TheFuture = 'Budoucnost';
    public const ArcticFuture = 'Ledová budoucnost';
    public const OceanicFuture = 'Oceánská budoucnost';
    public const VirtualFuture = 'Virtuální budoucnost';
    public const SpaceAgeMars = 'Kolonizace Marsu';
    public const SpaceAgeAsteroidBelt = 'Kolonizace pásu planetek';

    public const SA = self::StoneAge;
    public const BA = self::BronzeAge;
    public const IA = self::IronAge;
    public const EMA = self::EarlyMiddleAges;
    public const HMA = self::HighMiddleAges;
    public const LMA = self::LateMiddleAges;
    public const CA = self::ColonialAge;
    public const INA = self::IndustrialAge;
    public const PE = self::ProgressiveEra;
    public const ME = self::ModernEra;
    public const PME = self::PostmodernEra;
    public const CE = self::ContemporaryEra;
    public const TE = self::Tomorrow;
    public const FE = self::TheFuture;
    public const AF = self::ArcticFuture;
    public const OF = self::OceanicFuture;
    public const VF = self::VirtualFuture;
    public const SAM = self::SpaceAgeMars;
    public const SAAB = self::SpaceAgeAsteroidBelt;

    public const NAMES = [
        self::NoAge => 'NoAge',
        self::BronzeAge => 'BronzeAge',
        self::IronAge => 'IronAge',
        self::EarlyMiddleAges => 'EarlyMiddleAges',
        self::HighMiddleAges => 'HighMiddleAges',
        self::LateMiddleAges => 'LateMiddleAges',
        self::ColonialAge => 'ColonialAge',
        self::IndustrialAge => 'IndustrialAge',
        self::ProgressiveEra => 'ProgressiveEra',
        self::ModernEra => 'ModernEra',
        self::PostmodernEra => 'PostmodernEra',
        self::ContemporaryEra => 'ContemporaryEra',
        self::Tomorrow => 'Tomorrow',
        self::TheFuture => 'TheFuture',
        self::ArcticFuture => 'ArcticFuture',
        self::OceanicFuture => 'OceanicFuture',
        self::VirtualFuture => 'VirtualFuture',
        self::SpaceAgeMars => 'SpaceAgeMars',
        self::SpaceAgeAsteroidBelt => 'SpaceAgeAsteroidBelt',
    ];

    public string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }
}
