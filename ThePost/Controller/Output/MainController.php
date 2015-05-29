<?php
/**
 * Created by PhpStorm.
 * User: manuelmeister
 * Date: 14.05.15
 * Time: 00:25
 */

namespace ThePost\Controller\Output;

use ThePost\Controller\BasicController;
use ThePost\Model\Entity\User;
use ThePost\Model\Model;
use ThePost\Model\Repository\EntryRepository;
use ThePost\Model\Repository\OptionRepository;
use ThePost\View\FrontView;
use ThePost\View\View;

/**
 * Class MainController
 * @package ThePost\Controller
 */
class MainController extends BasicController{

    /**
     * @var Model
     */
    protected $model;

    /**
     * @var array
     */
    protected $options_array = array();

    /**
     * @param $model
     */
    function __construct($model)
    {
        $this->model = $model;
        $this->get_options();
    }

    public function view_set_vars()
    {
        $this->view->set_render_vars($this->options_array,$this->authentication);
    }

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
            $this->options_array[$option->getKey()] = $option->getValue();
        }
    }

    /**
     * @param $param
     */
    public function frontpage($param){
        $entry_repository = new EntryRepository($this->model->pdo);
        $entries = $entry_repository->findAll();
        $this->view = new FrontView($entries);
        $this->view->add_render_vars(array("site"=>array("home"=>true)));
    }

}