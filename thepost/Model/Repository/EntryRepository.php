<?php
/**
 * Created by PhpStorm.
 * User: manuelmeister
 * Date: 13.05.15
 * Time: 21:52
 */

namespace ThePost\Model\Repository;


/**
 * Class EntryRepository
 * @package ThePost\Model\Repository
 */
class EntryRepository {

    /**
     * @var \PDO
     */
    private $pdo;

    function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function findAll(){
        $stmt = $this->pdo->prepare('SELECT * FROM Entry');
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_CLASS, 'ThePost\Model\Entity\Entry');
    }

}