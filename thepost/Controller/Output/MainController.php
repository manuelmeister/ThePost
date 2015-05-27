<?php
/**
 * Created by PhpStorm.
 * User: manuelmeister
 * Date: 14.05.15
 * Time: 00:25
 */

namespace ThePost\Controller\Output;

use ThePost\Model\Entity\User;
use ThePost\Model\Model;
use ThePost\Model\Repository\EntryRepository;
use ThePost\View\FrontView;
use ThePost\View\View;

/**
 * Class MainController
 * @package ThePost\Controller
 */
class MainController {

    /**
     * @var Model
     */
    protected $model;

    /**
     * @var View
     */
    public $view;

    /**
     * @var array
     */
    protected $options_array = array();

    /**
     * @var User
     */
    protected $authentication;

    /**
     * @param $model
     */
    function __construct($model)
    {
        $this->model = $model;
        $this->get_options();
    }

    /**
     * @param $authentication
     */
    public function set_authentication($authentication)
    {
        $this->authentication = $authentication;
    }

    public function set_vars()
    {
        $this->view->set_render_vars($this->options_array,$this->authentication);
    }

    public function get_options()
    {
        $stmt = $this->model->pdo->prepare('SELECT * FROM Options;');
        $stmt->execute();
        $options = $stmt->fetchAll(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'ThePost\Model\Entity\Options');

        foreach ($options as $option) {
            /** @var ThePost/Model/Entity/Options $option */
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