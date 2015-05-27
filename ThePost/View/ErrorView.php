<?php
/**
 * Created by PhpStorm.
 * User: manuelmeister
 * Date: 15.05.15
 * Time: 08:11
 */

namespace ThePost\View;


class ErrorView extends View{

    function __construct($param)
    {
        parent::__construct();

        $this->render_vars['error'] = array(
            'msg'   =>  $param
        );

        $this->render_vars['type'] = 'Page';

        $this->set_template('error.twig');
    }
}