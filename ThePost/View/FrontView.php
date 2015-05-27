<?php
/**
 * Created by PhpStorm.
 * User: manuelmeister
 * Date: 14.05.15
 * Time: 00:43
 */

namespace ThePost\View;


class FrontView extends View {

    function __construct($entries)
    {
        parent::__construct();

        $this->render_vars['entries'] = $entries;

        $this->set_template("index.twig");
    }
}