<?php
/**
 * Created by PhpStorm.
 * User: bmeism
 * Date: 28.05.2015
 * Time: 15:50
 */

namespace ThePost\Controller\Output;

use ThePost\Controller\BasicController;
use ThePost\Model\Model;
use ThePost\Model\Repository\OptionRepository;
use ThePost\View\InstallView;

/**
 * Class InstallController
 * @package ThePost\Controller\Output
 */
class InstallController extends BasicController
{

    /**
     *
     */
    public function install()
    {
        $this->view = new InstallView();
    }

    /**
     *
     */
    public function publish()
    {
        var_dump($_POST);
        if (isset($_POST['database'])) {
            $database = $_POST['database'];

            foreach ($database as $key => $value) {
                if (empty($value)) {
                    throw new \Exception("Database Config: $key not set");
                }
            }


            $json = json_encode($database);
            file_put_contents('config.json', $json);
            unset($_POST['database']);

            $model = new Model();

            $tables['entry'] = "CREATE TABLE IF NOT EXISTS `Entry` (
            `id` INT(11) NOT NULL AUTO_INCREMENT,
            `user_id` INT(11) NOT NULL,
            `slug` VARCHAR(100) NOT NULL,
            `title` VARCHAR(100) NOT NULL,
            `content` TEXT NOT NULL,
            `timestamp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (`id`)
            ) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8";

            $tables['options'] = "CREATE TABLE IF NOT EXISTS `Options` (
            `key` VARCHAR(100) CHARACTER SET utf8 NOT NULL DEFAULT '',
            `value` VARCHAR(200) CHARACTER SET utf8 DEFAULT NULL,
            `title` VARCHAR(100) COLLATE utf8_unicode_ci NOT NULL,
            `description` VARCHAR(200) COLLATE utf8_unicode_ci NOT NULL,
            `type` VARCHAR(100) COLLATE utf8_unicode_ci DEFAULT 'text',
            PRIMARY KEY (`key`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";

            $tables['users'] = "CREATE TABLE IF NOT EXISTS `User` (
            `id` INT(11) NOT NULL AUTO_INCREMENT,
            `username` VARCHAR(100) NOT NULL,
            `email` VARCHAR(255) DEFAULT '',
            `password_hash` VARCHAR(255) DEFAULT NULL,
            PRIMARY KEY (`id`)
            ) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8";

            foreach ($tables as $table) {
                $stmt = $model->pdo->prepare($table);
                $stmt->execute();
            }

            $option_repository = new OptionRepository($model->pdo);
            $settings = $_POST['setting'];
            foreach ($settings as $key => $value) {
                $option_repository->update($key, $value);
            }
            header("Location: /");
        } else {
            throw new \Exception("No database configurations given via <a href='/install/'>install</a>.");
        }
    }

}