<?php

namespace ThePost\View;


/**
 * Class FrontView
 * @package ThePost\View
 */
class FrontView extends View
{

    /**
     * @param $entries Array
     */
    function __construct($entries)
    {
        parent::__construct();

        $this->render_vars['entries'] = $entries;

        $this->set_template("index.twig");
    }
}