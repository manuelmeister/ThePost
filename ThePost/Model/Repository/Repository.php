<?php
/**
 * Created by PhpStorm.
 * User: bmeism
 * Date: 28.05.2015
 * Time: 09:51
 */

namespace ThePost\Model\Repository;


class Repository {

    /**
     * @var \PDO
     */
    protected $pdo;

    /**
     * @param $pdo
     */
    function __construct($pdo)
    {
        $this->pdo = $pdo;
    }
}