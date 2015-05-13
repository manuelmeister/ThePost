<?php
/**
 * Created by PhpStorm.
 * User: manuelmeister
 * Date: 14.05.15
 * Time: 00:27
 */

namespace ThePost\View;


class EntryErrorView extends View{

    function __construct($entry)
    {
        parent::__construct();

        $template = $this->twig->loadTemplate("error.twig");
        echo $template->render(array(
            'type'  =>  'Entry',
            'error' =>  $entry
        ));
    }
}