<?php
/**
 * Created by PhpStorm.
 * User: manuelmeister
 * Date: 14.05.15
 * Time: 00:27
 */

namespace ThePost\View;


use ThePost\Model\Entity\Entry;

/**
 * Class EntryErrorView
 * @package ThePost\View
 */
class EntryErrorView extends View{

    /**
     * Displays error view
     * @param $entry Entry
     */
    function __construct($entry)
    {
        parent::__construct();

        $this->render_vars['type'] = 'Entry';
        $this->render_vars['error'] = $entry;

        $this->set_template("error.twig");
    }
}