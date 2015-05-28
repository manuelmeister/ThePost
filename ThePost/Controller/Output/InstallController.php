<?php
/**
 * Created by PhpStorm.
 * User: bmeism
 * Date: 28.05.2015
 * Time: 15:50
 */

namespace ThePost\Controller\Output;

use ThePost\View\InstallView;

/**
 * Class InstallController
 * @package ThePost\Controller\Output
 */
class InstallController extends MainController{

    /**
     *
     */
    public function install()
    {
        $this->view = new InstallView();
    }

}