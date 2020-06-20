<?php


namespace Sample\Config;


class ConfigClass
{
    /**
     * @var string
     */
    private $dsn;

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $password;


    public function __construct()
    {
        $this->dsn = "mysql:host=db;dbname=content";
        $this->username = 'root';
        $this->password = 'root';
    }

    /**
     * @return string
     */
    public function getDsn(): string
    {
        return $this->dsn;
    }

    /**
     * @return string
     */
    public function getUserName(): string
    {
        return $this->username;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

}