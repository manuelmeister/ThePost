<?php
/**
 * Created by PhpStorm.
 * User: manuelmeister
 * Date: 16.05.15
 * Time: 17:54
 */

namespace ThePost\View;


class LoginView extends View {

    function __construct($options,$auth)
    {
        parent::__construct();

        $this->set_template('login.twig');
        echo $this->template->render(array(
            'options'   =>  $options,
            'auth'      =>  array(
                'failed'    =>  $auth
            )
        ));
    }
}