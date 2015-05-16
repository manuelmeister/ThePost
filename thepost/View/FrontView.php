<?php
/**
 * Created by PhpStorm.
 * User: manuelmeister
 * Date: 14.05.15
 * Time: 00:43
 */

namespace ThePost\View;


class FrontView extends View {

    function __construct($entries,$options)
    {
        parent::__construct();

        $this->set_template("index.twig");
        echo $this->template->render(array(
            'options'  =>  $options,
            'entries' =>  $entries
        ));
    }
}