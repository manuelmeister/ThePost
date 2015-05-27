<?php
/**
 * Created by PhpStorm.
 * User: manuelmeister
 * Date: 14.05.15
 * Time: 12:49
 */

namespace ThePost\Controller\Output;


use ThePost\Model\Repository\EntryRepository;
use ThePost\View\FrontView;
use ThePost\View\LoginView;

class LoginController extends MainController {

    public function login(){
        $this->view = new LoginView();
        $this->view->add_render_vars(array("site"=>array("login"=>true)));
    }

    public function submit(){
        if(isset($_POST['login'])){
            $username = trim($_POST['username']);
            $password = trim($_POST['password']);

            $stmt = $this->model->pdo->prepare('SELECT id,password_hash FROM User WHERE email=:username OR username=:username LIMIT 1;');
            $stmt->bindParam(':username',$username);
            $stmt->execute();

            $login_user = $stmt->fetch();

            if(password_verify($password,$login_user['password_hash'])){

                $_SESSION['user_id'] = $login_user['id'];

                parent::frontpage(array());

            }else{
                $this->view = new LoginView();
                $this->view->add_render_vars(array('auth'=>array('failed'=>true)));
            }

        }
    }

    public function logout()
    {
        unset($_SESSION['user_id']);

        parent::frontpage(array());
        $this->view->add_render_vars(array("site"=>array("home"=>true)));
    }
}