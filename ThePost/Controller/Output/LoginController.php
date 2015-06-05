<?php

namespace ThePost\Controller\Output;

use ThePost\View\LoginView;

/**
 * Class LoginController
 * @package ThePost\Controller\Output
 */
class LoginController extends MainController
{

    /**
     * Displays login
     */
    public function login()
    {
        $this->view = new LoginView();
        $this->view->add_render_vars(array("site" => array("login" => true)));
    }

    /**
     * Gets login per POST
     * @throws \Exception
     */
    public function submit()
    {
        if (isset($_POST['login'])) {
            $username = trim($_POST['username']);
            $password = trim($_POST['password']);

            $stmt = $this->model->pdo->prepare('SELECT id,password_hash FROM User WHERE email=:username OR username=:username LIMIT 1;');
            $stmt->bindParam(':username', $username);
            $stmt->execute();

            $login_user = $stmt->fetch();

            if (password_verify($password, $login_user['password_hash'])) {

                $_SESSION['user_id'] = $login_user['id'];

                parent::frontpage(array());

            } else {
                $this->view = new LoginView();
                $this->view->add_render_vars(array('auth' => array('failed' => true)));
            }

        } else {
            header("HTTP/1.0 406 No content given via POST", true, 406);
            throw new \Exception("No login details given via <a href='/login/'>login</a>.");
        }
    }

    /**
     * Loggs the user out and unsets the SESSION
     */
    public function logout()
    {
        unset($_SESSION['user_id']);

        parent::frontpage(array());
        $this->view->add_render_vars(array("site" => array("home" => true)));
    }
}