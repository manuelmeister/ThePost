<?php
/**
 * Created by PhpStorm.
 * User: bmeism
 * Date: 13.05.2015
 * Time: 16:36
 */

namespace ThePost\Model;

use ThePost\Controller\Exception\ConfigException;

/**
 * Class Model
 * @package ThePost\Model
 */
class Model
{

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
        if (file_exists('config.json')) {


            try {
                $config = json_decode(file_get_contents('config.json'));
                if (is_a($config, 'stdClass')) {
                    foreach ($config as $key => $value) {
                        if (empty($value)) {
                            throw new \Exception("Database Config: $key not set");
                        }
                    }
                } else {
                    throw new \Exception("Database Config is not valid");
                }

                $dsn = "mysql:dbname={$config->name};host={$config->location};port={$config->port}";
                $user = $config->username;
                $password = $config->password;

                $this->pdo = new \PDO($dsn, $user, $password, array(\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
            } catch (\Exception $e) {
                throw new ConfigException($e->getMessage() . " <a class='btn btn-primary' href='/install/'>Configure Databse</a>");
            }

        } else {
            throw new ConfigException("Your database isn't yet configured! <a href='/install/'>Configure</a> it now.");
        }
    }
}+