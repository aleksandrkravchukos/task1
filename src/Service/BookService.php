<?php declare(strict_types=1);

namespace Sample\Service;

use PDOException;
use Sample\Exception\BookCreationException;
use Sample\Repository\BookRepositoryInterface;

class BookService implements BookServiceInterface
{
    /**
     * @var BookRepositoryInterface
     */
    private BookRepositoryInterface $repository;

    public function __construct(BookRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Insert one row to DB.
     *
     * @param string $srt
     * @param string $bookName
     *
     * @throws BookCreationException
     */
    public function insertRow(string $srt, string $bookName): void
    {
        try {
            $this->repository->insertRow($srt, $bookName);
        } catch (PDOException $exception) {
            if ($exception->errorInfo[1] === self::ERROR_DUPLICATE_CODE) {
                throw new BookCreationException('Book sentence with this text already exist');
            }
        }
    }

}
