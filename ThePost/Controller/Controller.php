<?php

namespace ThePost\Controller;


use ThePost\Controller\CRUD\CRUDController;
use ThePost\Controller\Exception\ConfigException;
use ThePost\Controller\Output\InstallController;
use ThePost\Controller\Output\MainController;
use ThePost\Model\Entity\User;
use ThePost\Model\Model;
use ThePost\Model\Repository\UserRepository;
use ThePost\View\ErrorView;

/**
 * Class Controller
 * @package ThePost\Controller
 */
class Controller
{

    /**
     * @var Model
     */
    private $model;

    /**
     * @var RequestHandler
     */
    private $request;

    /**
     * @var BasicController|MainController
     */
    private $controller;

    /**
     * @var User
     */
    private $user;

    /**
     * Initialize controller
     */
    function __construct()
    {
        try {
            $this->model = new Model();

            session_start();

            try {

                //If you are already logged in
                $this->session_management();

                $this->create_controller();

                //If you have logged you out (via LoginController)
                $this->session_management();
                if (!$this->controller instanceof CRUDController) {
                    $this->init_vars();

                    echo $this->controller->view->render();
                }
            } catch (\Exception $e) {
                // Catch every thrown error that's inside creation block
                $this->controller->view = new ErrorView('Error: ', '', $e->getMessage());
                if ($this->controller->model != null) {
                    $this->controller->get_options();
                    $this->controller->view_set_vars();
                }
                echo $this->controller->view->render();
            }


        } catch (ConfigException $e) {
            //wrong configuration
            $this->controller = new InstallController();
            try {
                $this->controller->publish();
                $this->model = new Model();
                $this->controller = new MainController($this->model);
                $this->controller->frontpage(array());
                $this->controller->view->add_render_vars(array('error' => array(
                    'msg' => $e->getMessage(),
                    'true' => false
                )));
                $this->controller->get_options();
            } catch (\Exception $e) {
                $this->controller->install();
                $this->controller->view->add_render_vars(array('error' => array(
                    'msg' => $e->getMessage(),
                    'true' => true
                )));
            }
            echo $this->controller->view->render();
        } catch (\Exception $e) {
            //Other problem with the model
            $this->controller = new InstallController();
            $this->controller->install();
            $this->controller->view->add_render_vars(array('error' => array(
                'msg' => $e->getMessage(),
                'true' => true
            )));
            echo $this->controller->view->render();
        }

    }

    /**
     * Gets user from the database by the $_SESSION user_id variable
     * @uses $_SESSION['user_id']
     */
    private function session_management()
    {

        if (isset($_SESSION['user_id'])) {

            $user_repository = new UserRepository($this->model->pdo);
            $this->user = $user_repository->findUserByID($_SESSION['user_id']);
            $this->user->setLogin(true);

        } else {

            $this->user = new User();

        }

    }

    /**
     * $controller contains the path to the Controller that is actually used
     * $method contains the method used by the Controller
     * $param contains the parameter given by the route
     * @uses request
     */
    private function create_controller()
    {
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
     * Sets render vars
     */
    private function init_vars()
    {
        $this->controller->set_authentication($this->user);
        if (!$this->controller instanceof InstallController) {
            $this->controller->view_set_vars();
        }
    }

}