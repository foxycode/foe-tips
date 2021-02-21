<?php declare(strict_types=1);

namespace App\Model\Entities;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="building")
 * @ORM\Entity
 */
class Building
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var BuildingType
     *
     * @ORM\ManyToOne(targetEntity="App\Model\Entities\BuildingType")
     * @ORM\JoinColumns({
     *     @ORM\JoinColumn(name="building_type_id", referencedColumnName="id")
     * })
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="image_url", type="string", length=255, nullable=false)
     */
    private $imageUrl;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="wiki_url", type="string", length=255, nullable=false)
     */
    private $wikiUrl;

    /**
     * @var int
     *
     * @ORM\Column(name="size_width", type="integer", nullable=false)
     */
    private $sizeWidth;

    /**
     * @var int
     *
     * @ORM\Column(name="size_height", type="integer", nullable=false)
     */
    private $sizeHeight;

    /**
     * @var int
     *
     * @ORM\Column(name="size_area", type="integer", nullable=false)
     */
    private $sizeArea;

    /**
     * @var Collection|BuildingProduction[]
     *
     * @ORM\OneToMany(targetEntity="App\Model\Entities\BuildingProduction", mappedBy="building")
     * @ORM\OrderBy({"id" = "ASC"})
     */
    private $productions;

    public static function fromDTO(\App\Model\DTO\Building $dto, BuildingType $type, string $wikiUrl): self
    {
        $building = new self;

        $building->type = $type;
        $building->imageUrl = $dto->image;
        $building->name = $dto->name;
        $building->wikiUrl = $wikiUrl;
        $building->sizeWidth = $dto->size->width;
        $building->sizeHeight = $dto->size->height;
        $building->sizeArea = $dto->size->area;

        return $building;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getImageUrl(): string
    {
        return $this->imageUrl;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getWikiUrl(): string
    {
        return $this->wikiUrl;
    }

    public function getSizeWidth(): int
    {
        return $this->sizeWidth;
    }

    public function getSizeHeight(): int
    {
        return $this->sizeHeight;
    }

    public function getSizeArea(): int
    {
        return $this->sizeArea;
    }

    /**
     * @return BuildingProduction[]
     */
    public function getProductions(): array
    {
        return $this->productions->toArray();
    }
}
