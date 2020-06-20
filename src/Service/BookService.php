<?php

namespace Sample\Service;

use Sample\Repository\BookRepository;

class BookService
{
    /**
     * @var BookRepository
     */
    private $repository;

    /**
     * ServiceClass constructor.
     * @param BookRepository $repository
     */
    public function __construct(BookRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return BookRepository
     */
    public function getRepository(): BookRepository
    {
        return $this->repository;
    }

    /**
     * Insert one row to DB.
     *
     * @param string $srt
     */
    public function insertRow(string $srt): void
    {
        $this->repository->insertRow($srt);
    }

    /**
     * Delete all from book table.
     */
    public function deleteAllFromContent()
    {
        $this->repository->deleteAll();
    }

    /**
     * @return array
     */
    public function getAllFromBookTable()
    {
        return $this->repository->getAll();
    }

}