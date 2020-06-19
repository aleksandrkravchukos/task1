<?php


namespace Sample\Repository;


use Sample\Config\ConfigClass;

class RepositoryClass
{

    /**
     * @var ConfigClass
     */
    private $config;

    /**
     * RepositoryClass constructor.
     * @param ConfigClass $config
     */
    public function __construct(ConfigClass $config)
    {
        $this->config = $config;
    }

    /**
     * @return ConfigClass
     */
    public function getConfig(): ConfigClass
    {
        return $this->config;
    }
}