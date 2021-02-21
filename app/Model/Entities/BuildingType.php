<?php declare(strict_types=1);

namespace App\Model\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="building_type")
 * @ORM\Entity
 */
class BuildingType
{
    public const NAME_TO_ID = [
        'Obytné budovy' => 1,
        'Dílny' => 2,
        'Továrny' => 3,
        'Kulturní budovy' => 4,
        'Dekorace' => 5,
        'Vojenské budovy' => 6,
        'Cesty' => 7,
        'Věž' => 8,
    ];

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=64, nullable=false)
     */
    private $name;
}
