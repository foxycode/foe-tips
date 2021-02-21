<?php declare(strict_types=1);

namespace App\Model\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="age")
 * @ORM\Entity
 */
class Age
{
    public const NAME_TO_ID = [
        'Žádný věk' => 1,
        'Doba kamenná' => 2,
        'Doba bronzová' => 3,
        'Doba železná' => 4,
        'Raný středověk' => 5,
        'Vrcholný středověk' => 6,
        'Pozdní středověk' => 7,
        'Koloniální doba' => 8,
        'Průmyslový věk' => 9,
        'Doba Pokroku' => 10,
        'Moderní doba' => 11,
        'Postmoderní doba' => 12,
        'Současná éra' => 13,
        'Svět zítřka' => 14,
        'Budoucnost' => 15,
        'Ledová budoucnost' => 16,
        'Oceánská budoucnost' => 17,
        'Virtuální budoucnost' => 18,
        'Kolonizace Marsu' => 19,
        'Kolonizace pásu planetek' => 20,
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
