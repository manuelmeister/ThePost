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
class View
{

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
     * @var array
     */
    protected $render_vars = array();

    /**
     *
     */
    function __construct()
    {
        \Twig_Autoloader::register();
        $this->loader = new \Twig_Loader_Filesystem(__DIR__ . '/Templates');
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
     * @param $filename
     */
    protected function set_template($filename)
    {
        $this->template = $this->twig->loadTemplate($filename);
    }

    /**
     * @return string
     */
    public function render()
    {
        return $this->template->render($this->render_vars);
    }
}