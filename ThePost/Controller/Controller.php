<?php
/**
 * Created by PhpStorm.
 * User: bmeism
 * Date: 13.05.2015
 * Time: 15:45
 */

namespace ThePost\Controller;


use ThePost\Controller\CRUD\CRUDController;
use ThePost\Controller\Output\MainController;
use ThePost\Model\Entity\User;
use ThePost\Model\Model;
use ThePost\Model\Repository\UserRepository;

/**
 * Class Controller
 * @package ThePost\Controller
 */
class Controller {

    /**
     * @var Model
     */
    private $model;

    /**
     * @var RequestHandler
     */
    private $request;

    /**
     * @var MainController
     */
    private $controller;

    /**
     * @var User
     */
    private $user;

    /**
     *
     */
    function __construct()
    {
        $this->model = new Model();

        session_start();

        $this->session_management();
        $this->create_controller();
        $this->session_management();
        if(!$this->controller instanceof CRUDController){
            $this->init_vars();

            echo $this->controller->view->render();
        }
    }

    /**
     *
     */
    private function session_management(){

        if(isset($_SESSION['user_id'])){

            $user_repository = new UserRepository($this->model->pdo);
            $this->user = $user_repository->findUserByID($_SESSION['user_id']);
            $this->user->setLogin(true);

        }else{

            $this->user = new User();

        }

    }

    /**
     * $controller contains the path to the Controller that is actually used
     * $method contains the method used by the Controller
     * $param contains the parameter given by the route
     */
    private function create_controller(){
        $this->request = new RequestHandler($_SERVER['REQUEST_URI']);

        $controller = $this->request->getController();
        $method = $this->request->getMethod();
        $param = $this->request->getParam();

        //THE MAGIC: a new controller is instantiated using the string containing the namespace and name of the Controller
        $this->controller = new $controller($this->model);
        $this->controller->set_authentication($this->user);
        $this->controller->$method($param);
    }

    /**
     *
     */
    private function init_vars(){
        $this->controller->set_authentication($this->user);
        $this->controller->view_set_vars();
    }

}