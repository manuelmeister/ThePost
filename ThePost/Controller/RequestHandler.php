<?php

namespace ThePost\Controller;


/**
 * Class RequestHandler
 * @package ThePost\Controller
 */
class RequestHandler {

    /**
     * @var
     */
    private $uri;
    /**
     * associative array containing data from routing.yaml
     * @var array
     */
    private $routing_table;
    /**
     * @var
     */
    private $route;

    /**
     * @param $uri
     * @throws \Exception
     */
    function __construct($uri)
    {
        $this->uri = mb_split('\?',$uri)[0];
        $this->routing_table = \Spyc::YAMLLoadString(file_get_contents(__DIR__.'/routing.yaml'));
        $this->setRoute();
    }

    /**
     * check if elements of $routing_table match uri
     * @return bool
     * @throws \Exception
     */
    private function setRoute(){
        foreach ($this->routing_table as $route) {
            //route["params"] contains parameter like "slug", "page" or "id"
            if( preg_match($route['match'],$this->uri,$route['params']) ){
                $this->route = $route;
                return true;
            }
        }
        throw new \Exception("No Match: " . $this->uri,0);
    }

    /**
     * @return string
     */
    public function getController(){
        $controller = 'ThePost\\Controller\\'.$this->route['controller'];
        return $controller;
    }

    /**
     * @return mixed
     */
    public function getMethod(){
        return $this->route['method'];
    }

    /**
     * @return mixed
     */
    public function getParam()
    {
        return $this->route['params'];
    }

}