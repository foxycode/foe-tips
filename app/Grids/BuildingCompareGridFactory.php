<?php declare(strict_types=1);

namespace App\Grids;

use App\Libs\Foe\Images\PropertyImage;
use App\Model\Entities\Building;
use Nette\Utils\Html;
use Ublaboo\DataGrid\DataGrid;

final class BuildingCompareGridFactory
{
    public function __construct()
    {
    }

    public function create(): DataGrid
    {
        $grid = (new DataGrid)
            ->setPrimaryKey('id')
            ->setPagination(false)
            ->setRememberState(false);

        $grid->addColumnText('name', 'Název')
            ->setRenderer(function (Building $row) {
                $image = Html::el('img')
                    ->setAttribute('src', $row->getImageUrl())
                    ->setAttribute('style', 'width:22px');
                $link = Html::el('a')
                    ->setAttribute('href', $row->getWikiUrl())
                    ->setAttribute('target', '_blank')
                    ->setHtml($image);
                return Html::el('span')
                    ->addHtml($link)
                    ->addText(' ' . $row->getName());
            });

        $grid->addColumnText('size', PropertyImage::SIZE, 'sizeArea')
            ->setAlign('right')
            ->setRenderer(function (Building $row) {
                return $row->getSizeWidth() . 'x' . $row->getSizeHeight();
            });

        $grid->addColumnText('rank', PropertyImage::RANK, 'p.rank')
            ->setAlign('right')
            ->setRenderer(function (Building $row) {
                return $row->getProductions()[0]->getRank();
            });

        $grid->addColumnText('happiness', PropertyImage::HAPPINESS, 'p.happinessPerTile')
            ->setAlign('right')
            ->setRenderer(function (Building $row) {
                return $row->getProductions()[0]->getHappinessPerTile();
            });

        $grid->addColumnText('population', PropertyImage::POPULATION, 'p.populationPerTile')
            ->setAlign('right')
            ->setRenderer(function (Building $row) {
                return $row->getProductions()[0]->getPopulationPerTile();
            });

        $grid->addColumnText('attackBoostAttacker', PropertyImage::ATTACK_BOOST_ATTACKER, 'p.attackBoostAttackerPerTile')
            ->setAlign('right')
            ->setRenderer(function (Building $row) {
                return $row->getProductions()[0]->getAttackBoostAttackerPerTile();
            });

        $grid->addColumnText('defenseBoostAttacker', PropertyImage::DEFENSE_BOOST_ATTACKER, 'p.defenseBoostAttackerPerTile')
            ->setAlign('right')
            ->setRenderer(function (Building $row) {
                return $row->getProductions()[0]->getDefenseBoostAttackerPerTile();
            });

        $grid->addColumnText('money', PropertyImage::MONEY, 'p.moneyPerTile')
            ->setAlign('right')
            ->setRenderer(function (Building $row) {
                return $row->getProductions()[0]->getMoneyPerTile();
            });

        $grid->addColumnText('supplies', PropertyImage::SUPPLIES, 'p.suppliesPerTile')
            ->setAlign('right')
            ->setRenderer(function (Building $row) {
                return $row->getProductions()[0]->getSuppliesPerTile();
            });

        $grid->addColumnText('goods', PropertyImage::GOODS, 'p.goodsPerTile')
            ->setAlign('right')
            ->setRenderer(function (Building $row) {
                return $row->getProductions()[0]->getGoodsPerTile();
            });

        $grid->addColumnText('forgePoints', PropertyImage::FORGE_POINTS, 'p.forgePointsPerTile')
            ->setAlign('right')
            ->setRenderer(function (Building $row) {
                return $row->getProductions()[0]->getForgePointsPerTile();
            });

        return $grid;
    }
}
