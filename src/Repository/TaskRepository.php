<?php

namespace App\Repository;

use App\Entity\Task;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
* @method Task|null find($id, $lockMode = null, $lockVersion = null)
* @method Task|null findOneBy(array $criteria, array $orderBy = null)
* @method Task[]    findAll()
* @method Task[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
*/
class TaskRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Task::class);
    }

    public function findAll()
    {
        return $this->createQueryBuilder('t')
        ->orderBy('t.state')
        ->getQuery()
        ->getResult();
    }

    public function findToDoTasks(): array
    {
        return $this->createQueryBuilder('t')
        ->where('t.state = 0')
        ->orderBy('t.creation_date', 'DESC')
        ->getQuery()
        ->getResult();
    }

    public function findInProg(): array
    {
        return $this->createQueryBuilder('t')
        ->where('t.state = 1')
        ->orderBy('t.creation_date', 'DESC')
        ->getQuery()
        ->getResult();
    }

    public function findDoneTasks(): array
    {
        return $this->createQueryBuilder('t')
        ->where('t.state = 2')
        ->orderBy('t.creation_date', 'DESC')
        ->getQuery()
        ->getResult();
    }

    public function countTasks()
    {
        $countTasks = $this->createQueryBuilder('t')
        ->select('COUNT(t.id) as countTasks')
        ->getQuery()
        ->getSingleScalarResult();
    }
}
