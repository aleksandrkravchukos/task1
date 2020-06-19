<?php declare(strict_types=1);

namespace Sample;

use Sample\Config\ConfigClass;
use Sample\Repository\RepositoryClass;
use Sample\Service\ServiceClass;

require 'vendor/autoload.php';

$config = new ConfigClass('localhost', 'root', 'root');

$repository = new RepositoryClass($config);

$service = new ServiceClass($repository);

echo $service->insertRow();
