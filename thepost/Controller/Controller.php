<?php
/**
 * Created by PhpStorm.
 * User: bmeism
 * Date: 13.05.2015
 * Time: 15:45
 */

namespace ThePost\Controller;


use ThePost\Model\Model;

class Controller {

    /**
     * @var Model
     */
    public $model;
    public $current;

    function __construct()
    {
        $this->model = new Model();

        $request = new RequestHandler($_SERVER['REQUEST_URI']);
        $controller = $request->getController();
        $method = $request->getMethod();
        $param = $request->getParam();

        //TODO Add authentication here
        $this->current = new $controller($this->model);
        $this->current->$method($param);
    }

}