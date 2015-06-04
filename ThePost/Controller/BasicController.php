<?php

namespace ThePost\Controller;


use ThePost\Model\Entity\Options;
use ThePost\Model\Entity\User;
use ThePost\Model\Model;
use ThePost\Model\Repository\OptionRepository;
use ThePost\View\View;

/**
 * Class BasicController
 * @package ThePost\Controller
 */
class BasicController {

    /**
     * @var View
     */
    public $view;

    /**
     * @var Model
     */
    public $model;

    /**
     * @var array
     */
    protected $options_array = array();

    /**
     * Gets all Settings(Options) from Repository and fills it in an associative array like:
     *
     *      array(
     *          key1 => value1
     *          key2 => value2
     *      )
     *
     */
    public function get_options()
    {
        $options_repository = new OptionRepository($this->model->pdo);
        $options = $options_repository->findAll();

        foreach ($options as $option) {
            /** @var Options $option */
            $this->options_array[$option->getKey()] = $option->getValue();
        }
    }

    /**
     * Set render vars
     */
    public function view_set_vars()
    {
        $this->view->set_render_vars($this->options_array,$this->authentication);
    }

    /**
     * @var User
     */
    protected $authentication;

    /**
     * @param $authentication User
     */
    public function set_authentication($authentication)
    {
        $this->authentication = $authentication;
    }
}