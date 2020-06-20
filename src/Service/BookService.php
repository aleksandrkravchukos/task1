<?php

namespace Sample\Service;

use PDOException;
use Sample\Constant;
use Sample\Exception\BookCreationException;
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
     * Insert one row to DB.
     *
     * @param string $srt
     * @param string $bookName
     * @throws BookCreationException
     */
    public function insertRow(string $srt, string $bookName): void
    {
        try {
            $this->repository->insertRow($srt, $bookName);
        } catch (PDOException $exception) {
            if ($exception->errorInfo[1] == Constant::ERROR_DUPLICATE_CODE) {
                throw new BookCreationException('Book sentence with this text already exist');

            }
        }
    }

}