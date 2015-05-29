<?php
/**
 * Created by PhpStorm.
 * User: bmeism
 * Date: 29.05.2015
 * Time: 09:28
 */

namespace ThePost\Controller;


use ThePost\Model\Entity\User;
use ThePost\View\View;

/**
 * Class BasicController
 * @package ThePost\Controller
 */
class BasicController {

    /**
     * @var View
     */
    public $view;

    /**
     * @var User
     */
    protected $authentication;

    /**
     * @param $authentication
     */
    public function set_authentication($authentication)
    {
        $this->authentication = $authentication;
    }
}