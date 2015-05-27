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
     * @param $key
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
     * @param $key
     * @param $value
     */
    public function update($key, $value){
        var_dump($key);
        var_dump($value);
        $stmt = $this->pdo->prepare('UPDATE Options SET `value`=:str_value WHERE `key`=:str_key;');
        $stmt->bindParam(':str_value',$value);
        $stmt->bindParam(':str_key',$key);
        var_dump($stmt->execute());
    }
}