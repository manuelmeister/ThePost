<?php
/**
 * Created by PhpStorm.
 * User: bmeism
 * Date: 05.06.2015
 * Time: 15:30
 */

namespace ThePost\View\Templates;

use ThePost\View\View;

class RegisterView extends View{

    function __construct()
    {
        parent::__construct();

        $this->set_template('register.twig');
    }
}