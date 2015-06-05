<?php

namespace ThePost\Controller\Output;

use ThePost\Controller\BasicController;
use ThePost\Model\Model;
use ThePost\Model\Repository\EntryRepository;
use ThePost\View\FrontView;

/**
 * Class MainController
 * @package ThePost\Controller
 */
class MainController extends BasicController{

    /**
     * @param $model Model
     */
    function __construct($model)
    {
        $this->model = $model;
        $this->get_options();
    }

    /**
     * Displays all entries
     * @param $param Array
     */
    public function frontpage($param){
        $entry_repository = new EntryRepository($this->model->pdo);
        $entries = $entry_repository->findAll();
        $this->view = new FrontView($entries);
        $this->view->add_render_vars(array("site"=>array("home"=>true)));
    }

}