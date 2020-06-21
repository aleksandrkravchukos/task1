<?php

namespace Sample\Service;

interface BookServiceInterface
{
    public function insertRow(string $srt, string $bookName): void;

}