<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Book;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\DBAL\LockMode;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Book>
 *
// * @method Book|null find(mixed $id, LockMode|int|null $lockMode = null, int|null $lockVersion = null)
// * @method Book|null findOneBy(array $criteria, ?array $orderBy = null)
// * @method Book[]    findAll()
// * @method Book[]    findBy(array $criteria, ?array $orderBy = null, ?int $limit = null, ?int $offset = null)
// */
class BookRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Book::class);
    }

    /**
     * @return Book[] Returns an array of Book objects
     */
    public function findByExampleField(int $userId): array
    {
        return $this->createQueryBuilder('b')
            ->select(
                'b.name',
                'bc.name as categoryName',
                'bi.id as imageId',
                'u.email',
                'u.phone'
            )
            ->leftJoin('b.category', 'bc')
            ->innerJoin('b.image', 'bi')
            ->join(User::class , 'u')
            ->andWhere('u.id = :val')
            ->setParameter('val', $userId)
            ->orderBy('b.id', 'DESC')
            ->setMaxResults(3)
            ->getQuery()
            ->getResult()
        ;
    }

    public function findOneBySomeField(string $text): ?Book
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.text LIKE :val')
            ->setParameter('val', '%' . $text . '%')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
}
