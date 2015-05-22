<?php
/**
 * Created by PhpStorm.
 * User: bwalkl
 * Date: 22.05.2015
 * Time: 08:25
 */

namespace thepost\Model\Repository;
use ThePost\Model\Entity\Options;

class OptionRepository {
    /**
     * @var \PDO
     */
    private $pdo;

    /**
     * @param $pdo
     */
    function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * this functions finds an Entry by its ID
     * @param $param
     * @return Options
     */
    public function findByParam($key){
        $stmt = $this->pdo->prepare("SELECT * FROM Options WHERE 'key'=':key' OR slug=:param LIMIT 1");
        $stmt->bindParam(":key",$key);
        $stmt->execute();
        return $stmt->fetchObject('ThePost\Model\Entity\Options');
    }


    /**
     * @return array Options
     */
    public function findAll(){
        $stmt = $this->pdo->prepare('SELECT * FROM Options');
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_CLASS, 'ThePost\Model\Entity\Options');
    }


    /**
     * @param $id int
     * @param $title String
     * @param $text String
     */
    public function update($key, $value){
        $stmt = $this->pdo->prepare("UPDATE Options SET 'value'=':value' WHERE 'key'=':key';");
        $stmt->bindParam(':value',$value);
        $stmt->bindParam(':key',$key);
        $stmt->execute();
    }
}