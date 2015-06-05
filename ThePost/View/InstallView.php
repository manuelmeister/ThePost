<?php

namespace ThePost\View;


/**
 * Class InstallView
 * @package ThePost\View
 */
class InstallView extends View{

    /**
     * Displays install view
     */
    function __construct()
    {
        parent::__construct();

        $this->set_template("install.twig");
    }


}