<?php

namespace App\Repository;

use App\Entity\Author;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\DBAL\DriverManager;

/**
 * @extends ServiceEntityRepository<Author>
 *
 * @method Author|null find($id, $lockMode = null, $lockVersion = null)
 * @method Author|null findOneBy(array $criteria, array $orderBy = null)
 * @method Author[]    findAll()
 * @method Author[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AuthorRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Author::class);
    }

//    /**
//     * @return Author[] Returns an array of Author objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('a.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Author
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

//Query Builder: Question 1
public function showAllAuthorsOrderByEmail()
    {
        return $this->createQueryBuilder('a')
            ->orderBy('a.email','DESC')
            ->getQuery()
            //->getDQL() 
           ->getResult()
        ;
    }
public function showAllAuthorsOrderByEmailDql ()
{
    $em=$this->getEntityManager();
    return $em->createQuery(
        'SELECT a FROM App\Entity\Author a ORDER BY a.email DESC' 
    )->getResult() ; 
}
public function SearchAuthor($min,$max) 
{
    return $this->createQueryBuilder('a')
    ->select('a')
    ->where('a.nb_book BETWEEN :min AND :maw')
    ->setParameter('min',$min) 
    ->setParameter('maw',$max) 
    ->getQuery()
    ->getResult() ; 
}
//DQL Question 3
public function SearchAuthorDQL($min,$max){
    $em=$this->getEntityManager();
    return $em->createQuery(
        'select a from App\Entity\Author a WHERE 
        a.nb_books BETWEEN :min AND :max')
        ->setParameter("min",$min)
        ->setParameter("max",$max)
        ->getResult(); 
       
        ;
}

//DQL Question 4
public function DeleteAuthor(){
    $em=$this->getEntityManager();
    return $em->createQuery(
        'DELETE App\Entity\Author a WHERE a.nb_books = 0')
    ->getResult();
}
public function  DeleteAuthorquery ()
{
    return $this->createQueryBuilder("App\Entity\Author",'a')
    ->delete()
    ->where('a.nb_books = 0')
    ->getQuery()
    ->getResult()
    ;

}


}
