<?php


namespace Sample\Repository;


use Sample\Config\ConfigClass;

class RepositoryClass
{

    private $config;

    public function __construct(ConfigClass $config)
    {
        $this->config = $config;
    }

    public function getConfig()
    {
        return $this->config;
    }
}