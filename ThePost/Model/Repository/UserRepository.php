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

    /**
     * @param $username
     * @param $email
     * @param $password_hash
     * @return bool
     */
    public function add($username, $email, $password_hash)
    {
        $stmt = $this->pdo->prepare('INSERT INTO User(username, email, password_hash) VALUES (:username,:email,:password_hash);');
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password_hash', $password_hash);
        return $stmt->execute();
    }

}