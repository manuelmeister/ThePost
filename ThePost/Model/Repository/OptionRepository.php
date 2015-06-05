<?php

namespace ThePost\Model\Repository;
use ThePost\Model\Entity\Options;

class OptionRepository extends Repository{

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
        $stmt = $this->pdo->prepare('SELECT * FROM Options;');
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_CLASS, 'ThePost\Model\Entity\Options');
    }


    /**
     * @param $key
     * @param $value
     */
    public function update($key, $value){
        $stmt = $this->pdo->prepare('UPDATE Options SET `value`=:str_value WHERE `key`=:str_key;');
        $stmt->bindParam(':str_value',$value,\PDO::PARAM_STR);
        $stmt->bindParam(':str_key',$key,\PDO::PARAM_STR);
        $stmt->execute();
    }
}