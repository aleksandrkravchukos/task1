<?php declare(strict_types=1);


namespace Sample\Config;

class ConfigClass
{
    /**
     * @var string
     */
    private string $dsn;

    /**
     * @var string
     */
    private string $username;

    /**
     * @var string
     */
    private string $password;


    public function __construct()
    {
        $this->dsn      = "mysql:host=db;dbname=content";
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
