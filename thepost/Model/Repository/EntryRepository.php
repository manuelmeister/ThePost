<?php
/**
 * Created by PhpStorm.
 * User: manuelmeister
 * Date: 13.05.15
 * Time: 21:52
 */

namespace ThePost\Model\Repository;
use HTMLPurifier;
use HTMLPurifier_Config;
use ThePost\Model\Entity\Entry;


/**
 * Class EntryRepository
 * @package ThePost\Model\Repository
 */
class EntryRepository {

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
     * @return Entry
     */
    public function findByParam($param){
        $stmt = $this->pdo->prepare('SELECT * FROM Entry WHERE id=:param OR slug=:param LIMIT 1');
        $stmt->bindParam(":param",$param);
        $stmt->execute();
        return $stmt->fetchObject('ThePost\Model\Entity\Entry');
    }


    /**
     * @return array
     */
    public function findAll(){
        $stmt = $this->pdo->prepare('SELECT * FROM Entry ORDER BY "timestamp"');
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_CLASS, 'ThePost\Model\Entity\Entry');
    }


    /**
     * @param $id int
     * @param $title String
     * @param $text String
     */
    public function update($id, $title, $text){

        $purifier_config = HTMLPurifier_Config::createDefault();
        $purifier = new HTMLPurifier($purifier_config);
        $clean_text = $purifier->purify($text);

        $stmt = $this->pdo->prepare('UPDATE Entry SET title=:title,content=:text WHERE id=:id;');
        $stmt->bindParam(':title',$title);
        $stmt->bindParam(':text',$clean_text);
        $stmt->bindParam(':id',$id);
        $stmt->execute();

    }



}