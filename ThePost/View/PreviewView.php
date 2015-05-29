<?php
/**
 * Created by PhpStorm.
 * User: manuelmeister
 * Date: 12.05.15
 * Time: 20:55
 */

namespace ThePost\View;


class PreviewView extends View{

    function __construct($entry)
    {
        parent::__construct();

        $this->render_vars['entry'] = $entry;

        $this->set_template("preview.twig");

    }

}