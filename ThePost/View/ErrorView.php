<?php

namespace ThePost\View;


/**
 * Class ErrorView
 * @package ThePost\View
 */
class ErrorView extends View
{

    /**
     * Displays error
     * @param $type String
     * @param $page String
     * @param $param String
     */
    function __construct($type, $page, $param)
    {
        parent::__construct();

        $this->render_vars['error'] = array(
            'msg' => $param,
            'page' => $page
        );

        $this->render_vars['type'] = $type;

        $this->set_template('error.twig');
    }
}