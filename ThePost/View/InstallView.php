<?php
/**
 * Created by PhpStorm.
 * User: bmeism
 * Date: 28.05.2015
 * Time: 15:52
 */

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