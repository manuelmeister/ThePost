<?php
/**
 * Created by PhpStorm.
 * User: bmeism
 * Date: 13.05.2015
 * Time: 15:45
 */

namespace ThePost\Controller;


use ThePost\Model\Entity\User;
use ThePost\Model\Model;

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
     * @var DefaultController
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

        $this->create_controller();
        $this->session_management();
        $this->init_vars();

        echo $this->controller->view->render();
    }

    /**
     *
     */
    private function session_management(){

        if(isset($_SESSION['user_id'])){

            $stmt = $this->model->pdo->prepare('SELECT * FROM `User` WHERE id =:id;');
            $stmt->bindParam(':id',$_SESSION['user_id']);
            $stmt->execute();
            $this->user = $stmt->fetchObject('ThePost\Model\Entity\User');

            $this->user->setLogin(true);
        }else{

            $this->user = new User();

        }

    }

    /**
     *
     */
    private function create_controller(){
        $this->request = new RequestHandler($_SERVER['REQUEST_URI']);

        $controller = $this->request->getController();
        $method = $this->request->getMethod();
        $param = $this->request->getParam();

        $this->controller = new $controller($this->model);
        $this->controller->$method($param);
    }

    /**
     *
     */
    private function init_vars(){
        $this->controller->set_authentication($this->user);
        $this->controller->set_vars();
    }

}