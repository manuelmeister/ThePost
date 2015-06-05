<?php

namespace ThePost\Model\Entity;


/**
 * Class User
 * @package ThePost\Model\Entity
 */
class User
{

    /**
     * @var int
     */
    private $id = 0;

    /**
     * @var string
     */
    private $username = "Anonymous";

    /**
     * @var null
     */
    private $email = null;

    /**
     * @var bool
     */
    private $login = false;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return null
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param null $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return boolean
     */
    public function isLogin()
    {
        return $this->login;
    }

    /**
     * @param boolean $login
     */
    public function setLogin($login)
    {
        $this->login = $login;
    }


}