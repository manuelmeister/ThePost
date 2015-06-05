<?php

namespace ThePost\View;


/**
 * Class LoginView
 * @package ThePost\View
 */
class LoginView extends View
{

    /**
     * Display Login
     */
    function __construct()
    {
        parent::__construct();

        $this->set_template('login.twig');
    }
}