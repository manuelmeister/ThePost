<?php
/**
 * Created by PhpStorm.
 * User: manuelmeister
 * Date: 15.05.15
 * Time: 08:08
 */

namespace ThePost\Controller;


use ThePost\View\ErrorView;

/**
 * Class ErrorController
 * @package ThePost\Controller
 */
class ErrorController extends DefaultController {

    /**
     * @param $param
     */
    public function front($param){
        new ErrorView($param['page'],$this->options_array);
    }
}