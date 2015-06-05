<?php

namespace ThePost\Controller\Output;

use ThePost\View\ErrorView;

/**
 * Class ErrorController
 * @package ThePost\Controller
 */
class ErrorController extends MainController
{

    /**
     * Displays an error
     * @param $param
     */
    public function frontpage($param)
    {
        $this->view = new ErrorView('Page ', $param['page'], 'not found!');
    }
}