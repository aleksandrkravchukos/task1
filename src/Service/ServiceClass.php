<?php


namespace Sample\Service;


use Sample\Repository\RepositoryClass;

class ServiceClass
{
    private $repository;

    public function __construct(RepositoryClass $repository)
    {
        $this->repository = $repository;
    }

    public function getRepository()
    {
        return $this->repository;
    }

    public function insertRow(){
        return 'test';
    }
}