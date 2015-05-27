<?php
/**
 * Created by PhpStorm.
 * User: bwalkl
 * Date: 22.05.2015
 * Time: 08:07
 */

namespace thepost\Controller\Output;

use thepost\Model\Repository\OptionRepository;
use thepost\View\SettingsView;

class SettingsController extends MainController {

    public function settings(){
        $options_repository = new OptionRepository($this->model->pdo);
        $options = $options_repository->findAll();
        $this->view = new SettingsView($options);
        $this->view->add_render_vars(array("site"=>array("settings"=>true)));
    }

}