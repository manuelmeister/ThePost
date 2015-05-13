<?php
/**
 * Created by PhpStorm.
 * User: bmeism
 * Date: 13.05.2015
 * Time: 15:46
 */

namespace ThePost\Controller;


class RequestHandler {

    private $url;
    private $routing_table;
    private $route;

    function __construct($url)
    {
        $this->url = $url;
        $this->routing_table = \Spyc::YAMLLoadString(file_get_contents(__DIR__.'/routing.yaml'));
        $this->setRoute();
    }

    private function setRoute(){
        foreach ($this->routing_table as $route) {
            if( preg_match($route['match'],$this->url,$route['params']) ){
                $this->route = $route;
                return true;
            }
        }
        throw new \Exception("No Match: " . $this->url,0);
    }

    public function getController(){
        $controller = 'ThePost\\Controller\\'.$this->route['controller'];
        return $controller;
    }

    public function getMethod(){
        return $this->route['method'];
    }

    public function getParam()
    {
        return $this->route['params'];
    }

}