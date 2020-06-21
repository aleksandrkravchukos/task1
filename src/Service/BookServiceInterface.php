<?php declare(strict_types=1);

namespace Sample\Service;

interface BookServiceInterface
{

    const ERROR_DUPLICATE_CODE = 1062;
    const SAMPLE_BOOK_NAME     = 'New book';

    public function insertRow(string $srt, string $bookName): void;

}
