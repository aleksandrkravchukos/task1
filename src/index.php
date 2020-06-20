<?php declare(strict_types=1);

namespace Sample;

use Sample\Config\ConfigClass;
use Sample\Repository\BookRepository;
use Sample\Service\BookService;

require 'vendor/autoload.php';

$config = new ConfigClass();

$repository = new BookRepository($config);

$service = new BookService($repository);

$insert = $service->insertRow();

var_dump($insert);
