<?php declare(strict_types=1);

namespace App\Model\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="building_production")
 * @ORM\Entity
 */
class BuildingProduction
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
     * @var Building
     *
     * @ORM\ManyToOne(targetEntity="App\Model\Entities\Building", inversedBy="productions")
     * @ORM\JoinColumns({
     *     @ORM\JoinColumn(name="building_id", referencedColumnName="id")
     * })
     */
    private $building;

    /**
     * @var Age
     *
     * @ORM\ManyToOne(targetEntity="App\Model\Entities\Age")
     * @ORM\JoinColumns({
     *     @ORM\JoinColumn(name="age_id", referencedColumnName="id")
     * })
     */
    private $age;

    /**
     * @var int|null
     *
     * @ORM\Column(name="rank", type="integer")
     */
    private $rank;

    /**
     * @var int|null
     *
     * @ORM\Column(name="happiness", type="integer", nullable=true)
     */
    private $happiness;

    /**
     * @var string|null
     *
     * @ORM\Column(name="happiness_tile", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $happinessPerTile;

    /**
     * @var int|null
     *
     * @ORM\Column(name="population", type="integer", nullable=true)
     */
    private $population;

    /**
     * @var string|null
     *
     * @ORM\Column(name="population_tile", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $populationPerTile;

    /**
     * @var int|null
     *
     * @ORM\Column(name="att_boost_attacker", type="integer", nullable=true)
     */
    private $attackBoostAttacker;

    /**
     * @var string|null
     *
     * @ORM\Column(name="att_boost_attacker_tile", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $attackBoostAttackerPerTile;

    /**
     * @var int|null
     *
     * @ORM\Column(name="def_boost_attacker", type="integer", nullable=true)
     */
    private $defenseBoostAttacker;

    /**
     * @var string|null
     *
     * @ORM\Column(name="def_boost_attacker_tile", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $defenseBoostAttackerPerTile;

    /**
     * @var int|null
     *
     * @ORM\Column(name="att_boost_defender", type="integer", nullable=true)
     */
    private $attackBoostDefender;

    /**
     * @var string|null
     *
     * @ORM\Column(name="att_boost_defender_tile", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $attackBoostDefenderPerTile;

    /**
     * @var int|null
     *
     * @ORM\Column(name="def_boost_defender", type="integer", nullable=true)
     */
    private $defenseBoostDefender;

    /**
     * @var string|null
     *
     * @ORM\Column(name="def_boost_defender_tile", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $defenseBoostDefenderPerTile;

    /**
     * @var int|null
     *
     * @ORM\Column(name="money", type="integer", nullable=true)
     */
    private $money;

    /**
     * @var string|null
     *
     * @ORM\Column(name="money_tile", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $moneyPerTile;

    /**
     * @var int|null
     *
     * @ORM\Column(name="supplies", type="integer", nullable=true)
     */
    private $supplies;

    /**
     * @var string|null
     *
     * @ORM\Column(name="supplies_tile", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $suppliesPerTile;

    /**
     * @var int|null
     *
     * @ORM\Column(name="goods", type="integer", nullable=true)
     */
    private $goods;

    /**
     * @var string|null
     *
     * @ORM\Column(name="goods_tile", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $goodsPerTile;

    /**
     * @var int|null
     *
     * @ORM\Column(name="strategy_points", type="integer", nullable=true)
     */
    private $forgePoints;

    /**
     * @var string|null
     *
     * @ORM\Column(name="strategy_points_tile", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $forgePointsPerTile;

    /**
     * @var int|null
     *
     * @ORM\Column(name="military", type="integer", nullable=true)
     */
    private $military;

    /**
     * @var int|null
     *
     * @ORM\Column(name="medals", type="integer", nullable=true)
     */
    private $medals;

    /**
     * @var int|null
     *
     * @ORM\Column(name="premium", type="integer", nullable=true)
     */
    private $diamonds;

    /**
     * @var int|null
     *
     * @ORM\Column(name="great_building_bonus_guild_goods", type="integer", nullable=true)
     */
    private $guildGoods;

    public function __construct(Building $building, Age $age, int $rank = 0)
    {
        $this->building = $building;
        $this->age = $age;
        $this->rank = $rank;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRank(): int
    {
        return $this->rank;
    }

    public function setRank(int $rank): void
    {
        $this->rank = $rank;
    }

    public function getHappiness(): ?int
    {
        return $this->happiness;
    }

    public function getHappinessPerTile(): ?string
    {
        return $this->happinessPerTile;
    }

    public function setHappiness(?int $happiness): void
    {
        $this->happiness = $happiness;
        $this->happinessPerTile = $this->calculatePerTile($happiness);
    }

    public function getPopulation(): ?int
    {
        return $this->population;
    }

    public function getPopulationPerTile(): ?string
    {
        return $this->populationPerTile;
    }

    public function setPopulation(?int $population): void
    {
        $this->population = $population;
        $this->populationPerTile = $this->calculatePerTile($population);
    }

    public function getAttackBoostAttacker(): ?int
    {
        return $this->attackBoostAttacker;
    }

    public function getAttackBoostAttackerPerTile(): ?string
    {
        return $this->attackBoostAttackerPerTile;
    }

    public function setAttackBoostAttacker(?int $attackBoostAttacker): void
    {
        $this->attackBoostAttacker = $attackBoostAttacker;
        $this->attackBoostAttackerPerTile = $this->calculatePerTile($attackBoostAttacker);
    }

    public function getDefenseBoostAttacker(): ?int
    {
        return $this->defenseBoostAttacker;
    }

    public function getDefenseBoostAttackerPerTile(): ?string
    {
        return $this->defenseBoostAttackerPerTile;
    }

    public function setDefenseBoostAttacker(?int $defenseBoostAttacker): void
    {
        $this->defenseBoostAttacker = $defenseBoostAttacker;
        $this->defenseBoostAttackerPerTile = $this->calculatePerTile($defenseBoostAttacker);
    }

    public function getAttackBoostDefender(): ?int
    {
        return $this->attackBoostDefender;
    }

    public function getAttackBoostDefenderPerTile(): ?string
    {
        return $this->attackBoostDefenderPerTile;
    }

    public function setAttackBoostDefender(?int $attackBoostDefender): void
    {
        $this->attackBoostDefender = $attackBoostDefender;
        $this->attackBoostDefenderPerTile = $this->calculatePerTile($attackBoostDefender);
    }

    public function getDefenseBoostDefender(): ?int
    {
        return $this->defenseBoostDefender;
    }

    public function getDefenseBoostDefenderPerTile(): ?string
    {
        return $this->defenseBoostDefenderPerTile;
    }

    public function setDefenseBoostDefender(?int $defenseBoostDefender): void
    {
        $this->defenseBoostDefender = $defenseBoostDefender;
        $this->defenseBoostDefenderPerTile = $this->calculatePerTile($defenseBoostDefender);
    }

    public function getMoney(): ?int
    {
        return $this->money;
    }

    public function getMoneyPerTile(): ?string
    {
        return $this->moneyPerTile;
    }

    public function setMoney(?int $money): void
    {
        $this->money = $money;
        $this->moneyPerTile = $this->calculatePerTile($money);
    }

    public function getSupplies(): ?int
    {
        return $this->supplies;
    }

    public function getSuppliesPerTile(): ?string
    {
        return $this->suppliesPerTile;
    }

    public function setSupplies(?int $supplies): void
    {
        $this->supplies = $supplies;
        $this->suppliesPerTile = $this->calculatePerTile($supplies);
    }

    public function getGoods(): ?int
    {
        return $this->goods;
    }

    public function getGoodsPerTile(): ?string
    {
        return $this->goodsPerTile;
    }

    public function setGoods(?int $goods): void
    {
        $this->goods = $goods;
        $this->goodsPerTile = $this->calculatePerTile($goods);
    }

    public function getForgePoints(): ?int
    {
        return $this->forgePoints;
    }

    public function getForgePointsPerTile(): ?string
    {
        return $this->forgePointsPerTile;
    }

    public function setForgePoints(?int $forgePoints): void
    {
        $this->forgePoints = $forgePoints;
        $this->forgePointsPerTile = $this->calculatePerTile($forgePoints);
    }

    public function getMilitary(): ?int
    {
        return $this->military;
    }

    public function setMilitary(?int $military): void
    {
        $this->military = $military;
    }

    public function getMedals(): ?int
    {
        return $this->medals;
    }

    public function setMedals(?int $medals): void
    {
        $this->medals = $medals;
    }

    public function getDiamonds(): ?int
    {
        return $this->diamonds;
    }

    public function setDiamonds(?int $diamonds): void
    {
        $this->diamonds = $diamonds;
    }

    public function getGuildGoods(): ?int
    {
        return $this->guildGoods;
    }

    public function setGuildGoods(?int $guildGoods): void
    {
        $this->guildGoods = $guildGoods;
    }

    private function calculatePerTile(?int $value): ?string
    {
        return $value
            ? (string) round($value / $this->building->getSizeArea(), 2)
            : null;
    }
}
