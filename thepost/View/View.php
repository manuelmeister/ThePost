<?php
/**
 * Created by PhpStorm.
 * User: manuelmeister
 * Date: 12.05.15
 * Time: 21:34
 */

namespace ThePost\View;

/**
 * Class View
 * @package ThePost\View
 */
class View {

    /**
     * @var \Twig_Loader_Filesystem
     */
    private $loader;
    /**
     * @var \Twig_Environment
     */
    protected $twig;
    /**
     * @var \Twig_TemplateInterface
     */
    protected $template;

    /**
     *
     */
    function __construct()
    {
        \Twig_Autoloader::register();
        $this->loader = new \Twig_Loader_Filesystem(__DIR__.'/Templates');
        $this->twig = new \Twig_Environment($this->loader);
    }

    /**
     * @param $filename
     */
    protected function set_template($filename){
        $this->template = $this->twig->loadTemplate($filename);
    }
}