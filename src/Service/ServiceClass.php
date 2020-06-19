<?php


namespace Sample\Service;


use Sample\Repository\RepositoryClass;

class ServiceClass
{
    /**
     * @var RepositoryClass
     */
    private $repository;

    /**
     * ServiceClass constructor.
     * @param RepositoryClass $repository
     */
    public function __construct(RepositoryClass $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return RepositoryClass
     */
    public function getRepository(): RepositoryClass
    {
        return $this->repository;
    }

    /**
     * @return string
     */
    public function insertRow()
    {
        return 'test';
    }
}