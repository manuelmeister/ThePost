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

        $template = $this->twig->loadTemplate("entry.twig");
        echo $template->render(array(
            'options'  =>  $options,
            'entry' =>  $entry
        ));
    }
}