<?php

namespace ThePost\Model\Repository;

use HTMLPurifier;
use HTMLPurifier_Config;


/**
 * Class EntryRepository
 * @package ThePost\Model\Repository
 */
class EntryRepository extends Repository
{

    /**
     * this functions finds an Entry by its ID
     * @param $param
     * @return mixed
     */
    public function findByParam($param)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM Entry WHERE id=:param OR slug=:param LIMIT 1');
        $stmt->bindParam(":param", $param);
        $stmt->execute();
        return $stmt->fetchObject('ThePost\Model\Entity\Entry');
    }


    /**
     * @return array
     */
    public function findAll()
    {
        $stmt = $this->pdo->prepare('SELECT * FROM Entry ORDER BY timestamp DESC');
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_CLASS, 'ThePost\Model\Entity\Entry');
    }


    /**
     * @param $id int
     * @param $title String
     * @param $text String
     */
    public function update($id, $title, $text)
    {

        $clean_text = $this->clean_html($text);

        $stmt = $this->pdo->prepare('UPDATE Entry SET title=:title,content=:text WHERE id=:id;');
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':text', $clean_text);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

    }


    /**
     * @param $user_id int
     * @param $slug String URL (Title escaped)
     * @param $title String Title of the entry
     * @param $text String Content
     * @return bool Return false if operation fails
     */
    public function add($user_id, $slug, $title, $text)
    {


        $clean_text = $this->clean_html($text);

        $stmt = $this->pdo->prepare("INSERT INTO Entry (user_id, slug, title, content) VALUES ( :user_id, :slug, :title, :text);");
        $stmt->bindParam(':user_id', $user_id, \PDO::PARAM_INT);
        $stmt->bindParam(':slug', $slug, \PDO::PARAM_STR);
        $stmt->bindParam(':title', $title, \PDO::PARAM_STR);
        $stmt->bindParam(':text', $clean_text, \PDO::PARAM_STR);
        return $stmt->execute();

    }

    private function clean_html($text)
    {
        $purifier_config = HTMLPurifier_Config::createDefault();
        $purifier_config->set('Core.Encoding', 'UTF-8'); // replace with your encoding
        $purifier_config->set('HTML.Doctype', 'HTML 4.01 Transitional');
        $purifier_config->set('CSS.MaxImgLength', null); // allow any css
        $purifier_config->set('HTML.MaxImgLength', null); // allow any css
        $purifier = new HTMLPurifier($purifier_config);
        return $purifier->purify($text);

    }

    public function deleteById($id)
    {
        $stmt = $this->pdo->prepare('DELETE FROM Entry WHERE id=:id;');
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

}