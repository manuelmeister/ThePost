<?php

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