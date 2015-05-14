<?php
/**
 * Created by PhpStorm.
 * User: manuelmeister
 * Date: 12.05.15
 * Time: 21:34
 */

namespace ThePost\View;

class View {

    private $loader;
    protected $twig;
    protected $site;

    function __construct()
    {
        \Twig_Autoloader::register();
        $this->loader = new \Twig_Loader_Filesystem(__DIR__.'/Templates');
        $this->twig = new \Twig_Environment($this->loader);
    }
}