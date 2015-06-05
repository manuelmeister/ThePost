<?php

namespace ThePost\View;


use ThePost\Model\Entity\Entry;

/**
 * Class PreviewView
 * @package ThePost\View
 */
class PreviewView extends View{

    /**
     * Previews entry
     * @param $entry Entry
     */
    function __construct($entry)
    {
        parent::__construct();

        $this->render_vars['entry'] = $entry;

        $this->set_template("preview.twig");

    }

}