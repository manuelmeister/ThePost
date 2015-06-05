<?php

namespace ThePost\Model\Repository;


/**
 * Class UserRepository
 * @package ThePost\Model\Repository
 */
class UserRepository extends Repository
{

    /**
     * @param $id
     * @return mixed
     */
    public function findUserByID($id)
    {
        //:id is a placeholder for the id given in bindParam()
        $stmt = $this->pdo->prepare('SELECT id,email,username FROM `User` WHERE id =:id LIMIT 1;');
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
        $stmt->execute();
        //fill model with data from database
        return $stmt->fetchObject('ThePost\Model\Entity\User');
    }

}