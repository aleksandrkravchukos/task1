<?php declare(strict_types=1);

namespace SampleTest\Unit;

use PDO;
use PHPUnit\Framework\TestCase;
use Sample\Config\ConfigClass;
use Sample\Repository\BookRepository;
use Sample\Service\BookService;

/**
 * Class InvestmentTest
 */
class BookServiceTest extends TestCase
{
    private ConfigClass $config;

    /**
     * @var PDO
     */
    private $pdo;

    /**
     * @var BookService
     */
    private $service;

    /**
     * @var BookRepository
     */
    private $repository;

    protected function setUp(): void
    {
        $this->config = new ConfigClass();
        $this->pdo = new PDO($this->config->getDsn(), $this->config->getUserName(), $this->config->getPassword());
        $this->repository = new BookRepository($this->config);
        $this->service = new BookService($this->repository);
    }

    /**
     * @test
     */
    public function canAddString(): void
    {
        echo PHP_EOL . 'canAddString' . PHP_EOL;

        $str = file_get_contents('./fixtures/SampleText.txt');
        $this->service->deleteAllFromContent();
        $this->service->insertRow($str);

        $getAllFromDb = $this->service->getAllFromBookTable();

        $this->assertEquals($str, $getAllFromDb[0]);

    }

    /**
     * @test
     */
    public function canAddDuplicateText(): void
    {
        echo PHP_EOL . 'canAddDuplicateText' . PHP_EOL;
        $firstText = file_get_contents('./fixtures/SampleText.txt');
        $secondText = file_get_contents('./fixtures/SampleText.txt');

        $this->service->deleteAllFromContent();

        $this->service->insertRow($firstText);
        $this->service->insertRow($secondText);

        $this->assertEquals($firstText, $secondText);

    }

    /**
     * @test
     */
    public function canAddAnotherText(): void
    {
        echo PHP_EOL . 'canAddAnotherText' . PHP_EOL;
        $firstText = file_get_contents('./fixtures/SampleText.txt');
        $secondText = file_get_contents('./fixtures/AnotherText.txt');

        $this->service->deleteAllFromContent();

        $this->service->insertRow($firstText);
        $this->service->insertRow($secondText);

        $this->assertNotEquals($firstText, $secondText);

    }
}