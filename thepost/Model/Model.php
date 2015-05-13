<?php
/**
 * Created by PhpStorm.
 * User: bmeism
 * Date: 13.05.2015
 * Time: 16:36
 */

namespace ThePost\Model;


class Model {

    public $pdo;

    function __construct()
    {
        $dsn = 'mysql:dbname=thepost;host=localhost';
        $user = 'thepost';
        $password = '1234';
        $this->pdo = new \PDO($dsn,$user,$password);
    }
}