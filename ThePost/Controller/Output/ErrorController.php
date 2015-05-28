<?php
/**
 * Created by PhpStorm.
 * User: manuelmeister
 * Date: 15.05.15
 * Time: 08:08
 */

namespace ThePost\Controller\Output;

use ThePost\View\ErrorView;

/**
 * Class ErrorController
 * @package ThePost\Controller
 */
class ErrorController extends MainController {

    /**
     * @param $param
     */
    public function frontpage($param){
        $this->view = new ErrorView('Page ',$param['page'],'not found!');
    }
}