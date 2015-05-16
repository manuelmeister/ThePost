<?php
/**
 * Created by PhpStorm.
 * User: manuelmeister
 * Date: 15.05.15
 * Time: 08:11
 */

namespace ThePost\View;


class ErrorView extends View{

    function __construct($param,$options)
    {
        parent::__construct();

        $this->set_template('error.twig');
        echo $this->template->render(array(
            'error' =>  array(
                'msg'   =>  $param
            ),
            'options'   =>  $options,
            'type'  =>  'Page'
        ));
    }
}