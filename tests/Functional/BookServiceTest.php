<?php declare(strict_types=1);

namespace SampleTest\Unit;

use PDO;
use PHPUnit\Framework\TestCase;
use Sample\Config\ConfigClass;
use Sample\Constant;
use Sample\Exception\BookCreationException;
use Sample\Repository\BookRepository;
use Sample\Service\BookService;

/**
 * Class InvestmentTest
 */
class BookServiceTest extends TestCase
{
    private ConfigClass $config;

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
        $pdo = new PDO($this->config->getDsn(), $this->config->getUserName(), $this->config->getPassword());
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->repository = new BookRepository($pdo);
        $this->service = new BookService($this->repository);

        $this->repository->truncate();
    }

    /**
     * @test
     */
    public function canAddString(): void
    {
        echo PHP_EOL . 'canAddString' . PHP_EOL;

        $bookName = Constant::SAMPLE_BOOK_NAME;
        $str = file_get_contents('./fixtures/SampleBigText.txt');
        $this->service->insertRow($str, $bookName);

        $bookRows = $this->repository->getAll();

        $this->assertCount(1, $bookRows);
        $this->assertEquals($str, $bookRows[0]['one_row']);
    }

    /**
     * @test
     */
    public function canAddDuplicateText(): void
    {
        echo PHP_EOL . 'canAddDuplicateText' . PHP_EOL;

        $this->expectException(BookCreationException::class);
        $this->expectExceptionMessage('Book sentence with this text already exist');

        $str = file_get_contents('./fixtures/SampleBigText.txt');
        $bookName = Constant::SAMPLE_BOOK_NAME;
        $this->service->insertRow($str, $bookName);
        // Inserting the same text twice
        $this->service->insertRow($str, $bookName);

        $bookRows = $this->repository->getAll();

        $this->assertCount(1, $bookRows);
        $this->assertEquals($str, $bookRows[0]['one_row']);


    }

    /**
     * @test
     */
    public function canAddAnotherText(): void
    {
        echo PHP_EOL . 'canAddAnotherText' . PHP_EOL;
        $firstText = file_get_contents('./fixtures/SampleBigText.txt');
        $secondText = file_get_contents('./fixtures/AnotherText.txt');
        $bookName = Constant::SAMPLE_BOOK_NAME;

        $this->service->insertRow($firstText, $bookName);
        $this->service->insertRow($secondText, $bookName);

        $bookRows = $this->repository->getAll();

        $this->assertCount(2, $bookRows);
        $this->assertEquals($firstText, $bookRows[0]['one_row']);
        $this->assertEquals($secondText, $bookRows[1]['one_row']);

    }
}