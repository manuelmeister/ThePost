<?php
/**
 * Created by PhpStorm.
 * User: bwalkl
 * Date: 22.05.2015
 * Time: 08:07
 */

namespace ThePost\Controller\Output;

use ThePost\Model\Repository\OptionRepository;
use ThePost\View\SettingsView;

class SettingsController extends MainController {

    public function settings(){
        $options_repository = new OptionRepository($this->model->pdo);
        $options = $options_repository->findAll();
        $this->view = new SettingsView($options);
        $this->view->add_render_vars(array("site"=>array("settings"=>true)));
    }

    public function saveAll(){
        $options_repository = new OptionRepository($this->model->pdo);

        var_dump($_POST['settings']);
        if(isset($_POST['settings'])){
            $settings = $_POST['settings'];

            foreach ($settings as $key => $value) {
                $options_repository->update($key,$value);
            }
        }

        $this->get_options();

        $options = $options_repository->findAll();
        $this->view = new SettingsView($options);
        $this->view->add_render_vars(array("site"=>array("settings"=>true)));
    }

}