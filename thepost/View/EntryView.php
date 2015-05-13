<?php
/**
 * Created by PhpStorm.
 * User: manuelmeister
 * Date: 12.05.15
 * Time: 20:55
 */

namespace Meister\MVC\View;


class EntryView extends View{

    function __construct($entry,$site)
    {
        parent::__construct();

        $template = $this->twig->loadTemplate("entry.twig");
        echo $template->render(array($site,$entry));
    }
}