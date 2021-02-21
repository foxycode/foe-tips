<?php declare(strict_types=1);

namespace App\Model\Facades;

use App\Model\Entities\Age;
use Nette\Utils\Arrays;
use Nettrine\ORM\EntityManagerDecorator;

final class AgeFacade
{
    private EntityManagerDecorator $entityManager;

    public function __construct(EntityManagerDecorator $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function createQueryBuilder(string $alias = 'a')
    {
        return $this->entityManager->createQueryBuilder()
            ->from(Age::class, $alias);
    }

    /**
     * @return array<string, string>
     */
    public function findForSelect(): array
    {
        $qb = $this->createQueryBuilder()
            ->select('a.id, a.name')
            ->orderBy('a.id');

        return Arrays::associate($qb->getQuery()->getArrayResult(), 'id=name');
    }
}
