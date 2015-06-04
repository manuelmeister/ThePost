<?php
/**
 * Created by PhpStorm.
 * User: bwalkl
 * Date: 22.05.2015
 * Time: 08:09
 */

namespace ThePost\View;

/**
 * Class SettingsView
 * @package ThePost\View
 */
class SettingsView extends View {

    /**
     * Displays settings page
     * @param $settings
     */
    function __construct($settings)
    {
        parent::__construct();

        $this->render_vars['settings'] = $settings;
        $this->set_template('settings.twig');
    }
}