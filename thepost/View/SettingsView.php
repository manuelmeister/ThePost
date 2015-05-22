<?php
/**
 * Created by PhpStorm.
 * User: bwalkl
 * Date: 22.05.2015
 * Time: 08:09
 */

namespace thepost\View;

use ThePost\View\View;

class SettingsView extends View {

    function __construct($settings)
    {
        parent::__construct();

        $this->render_vars['settings'] = $settings;
        $this->set_template('settings.twig');
    }
}