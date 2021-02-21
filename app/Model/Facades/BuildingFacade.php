<?php declare(strict_types=1);

namespace App\Model\Facades;

use App\Model\Entities\Age;
use App\Model\Entities\Building;
use App\Model\Entities\BuildingProduction;
use App\Model\Parsers\BuildingPageParser;
use Nettrine\ORM\EntityManagerDecorator;

final class BuildingFacade
{
    private EntityManagerDecorator $entityManager;

    public function __construct(EntityManagerDecorator $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function reload(int $id): void
    {
        $buildingEntity = $this->entityManager->find(Building::class, $id);

        $page = file_get_contents($buildingEntity->getWikiUrl());
        $building = BuildingPageParser::parse($page);
        dumpe($building);

        foreach ($building->properties as $age => $ageProperties) {
            /** @var BuildingProduction $buildingProductionEntity */
            $buildingProductionEntity = $this->entityManager->getRepository(BuildingProduction::class)
                ->findOneBy([
                    'building' => $buildingEntity->getId(),
                    'age' => Age::NAME_TO_ID[$age],
                ]);

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

            $this->entityManager->persist($buildingProductionEntity);
        }

        $this->entityManager->flush();
    }
}
