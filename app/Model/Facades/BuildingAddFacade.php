<?php declare(strict_types=1);

namespace App\Model\Facades;

use App\Model\Entities\Age;
use App\Model\Entities\Building;
use App\Model\Entities\BuildingProduction;
use App\Model\Entities\BuildingType;
use App\Model\Parsers\BuildingPageParser;
use Nettrine\ORM\EntityManagerDecorator;

final class BuildingAddFacade
{
    private EntityManagerDecorator $entityManager;

    public function __construct(EntityManagerDecorator $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function addFromCzechWiki(string $url): void
    {
        $page = file_get_contents($url);
        $building = BuildingPageParser::parse($page);

        $buildingTypeId = BuildingType::NAME_TO_ID[$building->type->name];
        $typeEntity = $this->entityManager->find(BuildingType::class, $buildingTypeId);
        $buildingEntity = Building::fromDTO($building, $typeEntity, $url);

        $this->entityManager->persist($buildingEntity);
        $this->entityManager->flush($buildingEntity);

        foreach ($building->properties as $age => $ageProperties) {
            $ageId = Age::NAME_TO_ID[$age];
            $ageEntity = $this->entityManager->find(Age::class, $ageId);

            $buildingProductionEntity = new BuildingProduction($buildingEntity, $ageEntity);
            isset($ageProperties['rank']) && $buildingProductionEntity->setRank($ageProperties['rank']->value->value);
            isset($ageProperties['happiness']) && $buildingProductionEntity->setHappiness($ageProperties['happiness']->value->value);
            isset($ageProperties['population']) && $buildingProductionEntity->setPopulation($ageProperties['population']->value->value);
            isset($ageProperties['att_boost_attacker']) && $buildingProductionEntity->setAttackBoostAttacker($ageProperties['att_boost_attacker']->value->value);
            isset($ageProperties['def_boost_attacker']) && $buildingProductionEntity->setDefenseBoostAttacker($ageProperties['def_boost_attacker']->value->value);
            isset($ageProperties['att_boost_defender']) && $buildingProductionEntity->setAttackBoostDefender($ageProperties['att_boost_defender']->value->value);
            isset($ageProperties['def_boost_defender']) && $buildingProductionEntity->setDefenseBoostDefender($ageProperties['def_boost_defender']->value->value);
            isset($ageProperties['money']) && $buildingProductionEntity->setMoney($ageProperties['money']->value->value);
            isset($ageProperties['supplies']) && $buildingProductionEntity->setSupplies($ageProperties['supplies']->value->value);
            isset($ageProperties['military']) && $buildingProductionEntity->setMilitary($ageProperties['military']->value->value);
            isset($ageProperties['all_goods_of_age']) && $buildingProductionEntity->setGoods($ageProperties['all_goods_of_age']->value->value);
            isset($ageProperties['random_good_of_age']) && $buildingProductionEntity->setGoods($ageProperties['random_good_of_age']->value->value);
            isset($ageProperties['medals']) && $buildingProductionEntity->setMedals($ageProperties['medals']->value->value);
            isset($ageProperties['premium']) && $buildingProductionEntity->setDiamonds($ageProperties['premium']->value->value);
            isset($ageProperties['strategy_points']) && $buildingProductionEntity->setForgePoints($ageProperties['strategy_points']->value->value);
            isset($ageProperties['great_building_bonus_guild_goods']) && $buildingProductionEntity->setGuildGoods($ageProperties['great_building_bonus_guild_goods']->value->value);

            // Věk (rowspan)
            // Poskytuje (colspan)
            // Vyrábí (colspan)
            // Náhodně vyrábí jedno z následujících: (colspan)
            // v případě motivace

            // supply_production (bonus v %)

            $this->entityManager->persist($buildingProductionEntity);
        }

        $this->entityManager->flush();
    }
}
