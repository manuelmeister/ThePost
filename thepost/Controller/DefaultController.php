<?php
/**
 * Created by PhpStorm.
 * User: manuelmeister
 * Date: 14.05.15
 * Time: 00:25
 */

namespace ThePost\Controller;


use ThePost\Model\Model;
use ThePost\View\View;

/**
 * Class DefaultController
 * @package ThePost\Controller
 */
class DefaultController {

    /**
     * @var Model
     */
    protected $model;

    /**
     * @var View
     */
    protected $view;

    /**
     * @var array
     */
    protected $options_array = array();

    /**
     * @param $model
     */
    function __construct($model)
    {
        $this->model = $model;

        $stmt = $this->model->pdo->prepare('SELECT * FROM Options;');
        $stmt->execute();
        $options = $stmt->fetchAll(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'ThePost\Model\Entity\Options');

        foreach ($options as $option) {
            /** @var ThePost/Model/Entity/Options $option */
            $this->options_array[$option->getKey()] = utf8_encode($option->getValue());
        }
    }

}