<?php
/**
 * Created by PhpStorm.
 * User: bmeism
 * Date: 13.05.2015
 * Time: 16:36
 */

namespace ThePost\Model;


/**
 * Class Model
 * @package ThePost\Model
 */
class Model {

    /**
     * FIY: PDO is a standardized wrapper for any database
     * @var \PDO
     */
    public $pdo;

    /**
     *
     */
    function __construct()
    {
        $dsn = 'mysql:dbname=thepost;host=localhost';
        $user = 'thepost';
        $password = '1234';
        $this->pdo = new \PDO($dsn,$user,$password, array(\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    }
}