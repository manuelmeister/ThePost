<?php
/**
 * Created by PhpStorm.
 * User: manuelmeister
 * Date: 13.05.15
 * Time: 18:06
 */

namespace ThePost\Model\Entity;


/**
 * Class Options
 * @package ThePost\Model\Entity
 */
class Options {

    /**
     * @var string
     */
    private $key;

    /**
     * @var string
     */
    private $value;

    /**
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @param string $key
     */
    public function setKey($key)
    {
        $this->key = $key;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param string $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    function __toString()
    {
       return $this->value;
    }


}