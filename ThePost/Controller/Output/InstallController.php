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
use ThePost\View\ErrorView;
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
        if (file_exists('config.json') && filesize('config.json') > 0) {
            $this->view = new ErrorView('Error: ','','Sorry, you\'ve already installed the database. To fix database configurations, access your webhost via FTP and edit the config.json file. </br> If you want to configure the settings, go to the <a href="/settings/">settings page</a>.');
        }else{
            $this->view = new InstallView();
        }
    }

    /**
     *
     */
    public function publish()
    {
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
            `id` INT(11) UNIQUE NOT NULL AUTO_INCREMENT,
            `user_id` INT(11) NOT NULL,
            `slug` VARCHAR(100) UNIQUE NOT NULL,
            `title` VARCHAR(100) NOT NULL,
            `content` TEXT NOT NULL,
            `timestamp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (`id`),
            FOREIGN KEY (`fk_user_id`) REFERENCES `User`(id) ON DELETE CASCADE
            ) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;";

            $tables['options'] = "CREATE TABLE IF NOT EXISTS `Options` (
            `key` VARCHAR(100) CHARACTER SET utf8 NOT NULL DEFAULT '',
            `value` VARCHAR(200) CHARACTER SET utf8 DEFAULT NULL,
            `title` VARCHAR(100) COLLATE utf8_unicode_ci NOT NULL,
            `description` VARCHAR(200) COLLATE utf8_unicode_ci NOT NULL,
            `type` VARCHAR(100) COLLATE utf8_unicode_ci DEFAULT 'text',
            PRIMARY KEY (`key`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;";

            $tables['users'] = "CREATE TABLE IF NOT EXISTS `User` (
            `id` INT(11) NOT NULL AUTO_INCREMENT,
            `username` VARCHAR(100) NOT NULL,
            `email` VARCHAR(255) DEFAULT '',
            `password_hash` VARCHAR(255) DEFAULT NULL,
            PRIMARY KEY (`id`)
            ) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;";

            $tables['install'] = "INSERT INTO Options (`key`, `value`, title, description, type) VALUES ('welcome_title', 'Welcome!', 'Welcome Title', 'Static welcome widget title', 'text');
            INSERT INTO `Options` (`key`, `value`, title, description, type) VALUES ('welcome_content', 'Hello, this is my blog.', 'Welcome Text', 'Static welcome widget content', 'text');
            INSERT INTO `Options` (`key`, `value`, title, description, type) VALUES ('title', 'Your Blog', 'Blogtitle', 'Title that gets displayed at the top of every page.', 'text');
            INSERT INTO `Options` (`key`, `value`, title, description, type) VALUES ('style_h2color', '#3873de', 'H2 Color', 'Color of the 2. Heading', 'color');
            INSERT INTO `Options` (`key`, `value`, title, description, type) VALUES ('style_h2color_hover', '#23527C', 'H2 Hover Color', 'Hover Color of the 2. Heading', 'color');
            INSERT INTO `Options` (`key`, `value`, title, description, type) VALUES ('style_backgroundcolor', '#efefef', 'Background Color', 'Background color of the site', 'color');
            INSERT INTO `Options` (`key`, `value`, title, description, type) VALUES ('copyright', '© The Post', 'Copyright', 'Copyright information in the footer.', 'text');
            ";

            foreach ($tables as $table) {
                $stmt = $model->pdo->prepare($table);
                $stmt->execute();
            }

            $option_repository = new OptionRepository($model->pdo);
            $settings = $_POST['setting'];
            foreach ($settings as $key => $value) {
                $option_repository->update($key, $value);
            }

            $username = $_POST['user']['username'];
            $email = $_POST['user']['email'];
            $password_hash = password_hash($_POST['user']['password'],PASSWORD_BCRYPT);

            $stmt = $model->pdo->prepare("INSERT INTO User (username, email, password_hash) VALUES (:username,:email,:password_hash);");
            $stmt->bindParam(':username',$username);
            $stmt->bindParam(':email',$email);
            $stmt->bindParam(':password_hash',$password_hash);
            $stmt->execute();


            header("Location: /");
        } else {
            throw new \Exception("No database configurations given via <a href='/install/'>install</a>.");
        }
    }

}