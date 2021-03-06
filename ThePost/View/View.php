<?php

namespace ThePost\View;

use Twig_Loader_Filesystem;


/**
 * Class View
 * @package ThePost\View
 */
class View
{

    /**
     * @var \Twig_Environment
     */
    protected $twig;
    /**
     * @var \Twig_TemplateInterface
     */
    protected $template;
    /**
     * @var array
     */
    protected $render_vars = array();
    /**
     * @var \Twig_Loader_Filesystem
     */
    private $loader;

    /**
     *
     */
    function __construct()
    {
        \Twig_Autoloader::register();
        $this->loader = new Twig_Loader_Filesystem(__DIR__ . '/Templates');
        $this->twig = new \Twig_Environment($this->loader);
    }

    /**
     * @param $options
     * @param $authentication
     */
    public function set_render_vars($options, $authentication)
    {
        $this->render_vars['options'] = $options;
        $this->render_vars['authentication'] = $authentication;
    }

    /**
     * @param $arr
     */
    public function add_render_vars($arr)
    {
        foreach ($arr as $var => $val) {
            $this->render_vars[$var] = $val;
        }
    }

    /**
     * @return string
     */
    public function render()
    {
        return $this->template->render($this->render_vars);
    }

    /**
     * @param $filename
     */
    protected function set_template($filename)
    {
        $this->template = $this->twig->loadTemplate($filename);
    }
}