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
    public $db;
    public $current;

    function __construct()
    {
        $this->db = new Model();

        $request = new RequestHandler($_SERVER['REQUEST_URI']);
        $controller = $request->getController();
        $method = $request->getMethod();
        $param = $request->getParam();

        $this->current = new $controller($this->db);
        $this->current->$method($param);
    }

}