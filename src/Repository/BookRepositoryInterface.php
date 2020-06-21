<?php declare(strict_types=1);


namespace Sample\Repository;


interface BookRepositoryInterface
{
    public function truncate(): void;

    public function insertRow(string $str, string $bookName): bool;

    public function getAll(): array;
}