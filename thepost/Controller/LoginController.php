<?php
/**
 * Created by PhpStorm.
 * User: manuelmeister
 * Date: 14.05.15
 * Time: 12:49
 */

namespace ThePost\Controller;


use ThePost\View\LoginView;

class LoginController extends DefaultController {

    public function login(){
        $this->view = new LoginView($this->options_array,$auth = null);
    }

    /**
     * @param $auth bool
     */
    public function submit($auth = null){
        $this->view = new LoginView($this->options_array,$auth);
    }
}