<?php declare(strict_types=1);

namespace App\Presenters;

use App\Forms\BuildingCompareFilterFormFactory;
use App\Grids\BuildingCompareGridFactory;
use App\Model\Entities\Building;
use Nette\Application\UI\Form;
use Nette\Application\UI\Presenter;
use Nettrine\ORM\EntityManagerDecorator;
use Ublaboo\DataGrid\DataGrid;

final class BuildingComparePresenter extends Presenter
{
    private BuildingCompareFilterFormFactory $buildingCompareFilterFormFactory;
    private BuildingCompareGridFactory $buildingCompareGridFactory;
    private EntityManagerDecorator $entityManager;

    public function __construct(
        BuildingCompareFilterFormFactory $buildingCompareFilterFormFactory,
        BuildingCompareGridFactory $buildingCompareGridFactory,
        EntityManagerDecorator $entityManager
    ) {
        parent::__construct();
        $this->buildingCompareFilterFormFactory = $buildingCompareFilterFormFactory;
        $this->buildingCompareGridFactory = $buildingCompareGridFactory;
        $this->entityManager = $entityManager;
    }

    public function actionDefault(): void
    {
    }

    public function actionCompare(string $compareBy): void
    {
        if (!in_array($compareBy, ['attackBoostAttacker', 'defenseBoostAttacker', 'goods', 'forgePoints'])) {
            $this->redirect('default');
        }

        $ageId = $this->buildingCompareFilterFormFactory->getAge();
        $qb = $this->entityManager->createQueryBuilder()
            ->select('b, p')
            ->from(Building::class, 'b')
            ->innerJoin('b.productions', 'p')
            ->where('p.age = :age')
            ->setParameter('age', $ageId);

        switch ($compareBy) {
            case 'attackBoostAttacker':
                $qb->andWhere('p.attackBoostAttacker IS NOT NULL')
                    ->orderBy('p.attackBoostAttackerPerTile', 'DESC');
                break;
            case 'defenseBoostAttacker':
                $qb->andWhere('p.defenseBoostAttacker IS NOT NULL')
                    ->orderBy('p.defenseBoostAttackerPerTile', 'DESC');
                break;
            case 'goods':
                $qb->andWhere('p.goods IS NOT NULL')
                    ->orderBy('p.goodsPerTile', 'DESC');
                break;
            case 'forgePoints':
                $qb->andWhere('p.forgePoints IS NOT NULL')
                    ->orderBy('p.forgePointsPerTile', 'DESC');
                break;
        }

        /** @var DataGrid $grid */
        $grid = $this->getComponent('buildingCompareGrid');
        $grid->setDataSource($qb);
    }

    public function renderCompare(string $compareBy)
    {
        $this->template->compareBy = $compareBy;
    }

    protected function createComponentBuildingCompareFilter(): Form
    {
        $form = $this->buildingCompareFilterFormFactory->create();

        $form->onSuccess[] = function () {
            $this->redirect('this');
        };

        return $form;
    }

    protected function createComponentBuildingCompareGrid(): DataGrid
    {
        return $this->buildingCompareGridFactory->create();
    }
}
