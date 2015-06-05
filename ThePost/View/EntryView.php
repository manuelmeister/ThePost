<?php

namespace ThePost\View;


/**
 * Class EntryView
 * @package ThePost\View
 */
class EntryView extends View
{

    /**
     * Calls parent
     */
    function __construct()
    {
        parent::__construct();
    }

    /**
     * Displays entry.twig
     */
    public function create()
    {
        $this->set_template("entry.twig");
    }

    /**
     * Displays entry.twig and show the entry
     * @param $entry
     */
    public function read($entry)
    {
        $this->render_vars['entry'] = $entry;
        $this->set_template("entry.twig");
    }
}