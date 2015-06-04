<?php
/**
 * Created by PhpStorm.
 * User: manuelmeister
 * Date: 16.05.15
 * Time: 17:54
 */

namespace ThePost\View;


/**
 * Class LoginView
 * @package ThePost\View
 */
class LoginView extends View {

    /**
     * Display Login
     */
    function __construct()
    {
        parent::__construct();

        $this->set_template('login.twig');
    }
}