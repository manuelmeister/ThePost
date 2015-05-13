<?php
/**
 * Created by PhpStorm.
 * User: bmeism
 * Date: 13.05.2015
 * Time: 16:44
 */

namespace ThePost\Controller;


use Meister\MVC\View\EntryView;
use Meister\MVC\View\View;
use ThePost\Model\Model;

/**
 * Class DefaultController
 * @package ThePost\Controller
 */
class DefaultController
{

    /**
     * @var Model
     */
    protected $db;

    /**
     * @param $db
     */
    function __construct($db)
    {
        $this->db = $db;
    }

    /**
     * @param $param
     */
    public function index($param)
    {
        $stmt = $this->db->pdo->prepare('SELECT ')
        $view = new EntryView();
    }

}