<?php
/**
 * Created by PhpStorm.
 * User: manuelmeister
 * Date: 12.05.15
 * Time: 20:55
 */

namespace ThePost\View;


class EntryView extends View{

    function __construct($entry,$options)
    {
        parent::__construct();

        $this->set_template("entry.twig");
        echo $this->template->render(array(
            'options'  =>  $options,
            'entry' =>  $entry
        ));
    }
}