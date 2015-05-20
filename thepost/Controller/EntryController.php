<?php
/**
 * Created by PhpStorm.
 * User: bmeism
 * Date: 13.05.2015
 * Time: 16:44
 */

namespace ThePost\Controller;

use ThePost\View\EntryErrorView;
use ThePost\View\EntryView;

/**
 * Class DefaultController
 * @package ThePost\Controller
 */
class EntryController extends DefaultController
{
    /**
     * @param $param
     */
    public function index($param)
    {
        $stmt = $this->model->pdo->prepare('SELECT * FROM Entry WHERE id=:param OR slug=:param;');
        $stmt->bindValue(':param', (isset($param['slug']))?$param['slug']:$param['id']);
        $stmt->execute();
        if($stmt->rowCount()<1){
            $this->view = new EntryErrorView(array('msg' => (isset($param['slug']))?$param['slug']:$param['id']));
        }else{
            $entry = $stmt->fetchObject('ThePost\Model\Entity\Entry');
            $this->view = new EntryView($entry);
        }
    }

}