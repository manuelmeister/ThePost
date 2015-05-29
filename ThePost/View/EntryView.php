<?php
/**
 * Created by PhpStorm.
 * User: manuelmeister
 * Date: 12.05.15
 * Time: 20:55
 */

namespace ThePost\View;


class EntryView extends View{

    function __construct()
    {
        parent::__construct();


    }

    public function create(){



        $this->set_template("entry.twig");

    }

    public function read($entry){

        $this->render_vars['entry'] = $entry;

        $this->set_template("entry.twig");

    }
}