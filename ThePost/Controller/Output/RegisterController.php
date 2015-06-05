<?php
/**
 * Created by PhpStorm.
 * User: bmeism
 * Date: 05.06.2015
 * Time: 15:32
 */

namespace ThePost\Controller\Output;


use ThePost\Model\Repository\UserRepository;
use ThePost\View\Templates\RegisterView;

class RegisterController extends MainController{

    public function register(){
        $this->view = new RegisterView();
        $this->view->add_render_vars(array("site" => array("register" => true)));
    }

    public function submit(){
        if (isset($_POST['register'])) {
            $username = trim($_POST['user']['username']);
            $email = trim($_POST['user']['email']);
            $password_hash = password_hash($_POST['user']['password'],PASSWORD_BCRYPT);

            $user_repository = new UserRepository($this->model->pdo);

            if ($user_repository->add($username,$email,$password_hash)) {

                header("Location: /");

            } else {
                $this->view = new RegisterView();
                $this->view->add_render_vars(array("site" => array("register" => true)));
                $this->view->add_render_vars(array('register' => array('failed' => true)));
            }

        } else {
            header("HTTP/1.0 406 No content given via POST", true, 406);
            throw new \Exception("No login details given via <a href='/register/'>register</a>.");
        }
    }
}