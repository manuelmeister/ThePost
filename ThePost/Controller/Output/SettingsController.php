<?php

namespace ThePost\Controller\Output;

use ThePost\Model\Repository\OptionRepository;
use ThePost\View\SettingsView;

/**
 * Class SettingsController
 * @package ThePost\Controller\Output
 */
class SettingsController extends MainController
{

    /**
     * Gets settings from options table and displays it via SettingsView
     */
    public function settings()
    {
        $options_repository = new OptionRepository($this->model->pdo);
        $options = $options_repository->findAll();
        $this->view = new SettingsView($options);
        $this->view->add_render_vars(array("site" => array("settings" => true)));
    }

    /**
     * Gets every $_POST['settings'] and updates the database
     */
    public function saveAll()
    {
        $options_repository = new OptionRepository($this->model->pdo);

        if (isset($_POST['settings'])) {
            $settings = $_POST['settings'];

            foreach ($settings as $key => $value) {
                $options_repository->update($key, $value);
            }
        }

        $this->get_options();

        $options = $options_repository->findAll();
        $this->view = new SettingsView($options);
        $this->view->add_render_vars(array("site" => array("settings" => true)));
    }

}