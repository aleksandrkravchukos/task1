<?php declare(strict_types=1);

namespace SampleTest\Unit;

use PDO;
use PHPUnit\Framework\TestCase;
use Sample\Config\ConfigClass;
use Sample\Exception\BookCreationException;
use Sample\Repository\BookRepository;
use Sample\Repository\BookRepositoryInterface;
use Sample\Service\BookService;
use Sample\Service\BookServiceInterface;

/**
 * Class InvestmentTest
 */
class BookServiceTest extends TestCase
{
    private ConfigClass $config;

    /**
     * @var PDO
     */
    private PDO $pdo;

    /**
     * @var BookRepositoryInterface
     */
    private BookRepositoryInterface $repository;

    /**
     * @var BookServiceInterface
     */
    private BookServiceInterface $service;

    protected function setUp(): void
    {
        $this->config       = new ConfigClass();
        $this->pdo          = new PDO($this->config->getDsn(), $this->config->getUserName(), $this->config->getPassword());
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->repository = new BookRepository($this->pdo);
        $this->service    = new BookService($this->repository);

        $this->truncateBooks();
    }

    /**
     * Delete all rows from database content and table book.
     */
    private function truncateBooks(): void
    {
        $query = "TRUNCATE `book`";
        $stmt  = $this->pdo->prepare($query);
        $stmt->execute();
    }

    /**
     * @return array
     */
    private function getAllBooks(): array
    {
        return $this->pdo->query('SELECT * FROM book')
            ->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @test
     */
    public function canAddString(): void
    {
        $bookName = BookServiceInterface::SAMPLE_BOOK_NAME;
        $str      = file_get_contents('./fixtures/SampleBigText.txt');
        $this->service->insertRow($str, $bookName);

        $bookRows = $this->getAllBooks();

        $this->assertCount(1, $bookRows);
        $this->assertEquals($str, $bookRows[0]['one_row']);
    }

    /**
     * @test
     */
    public function canAddDuplicateText(): void
    {
        $this->expectException(BookCreationException::class);
        $this->expectExceptionMessage('Book sentence with this text already exist');

        $str      = file_get_contents('./fixtures/SampleBigText.txt');
        $bookName = BookServiceInterface::SAMPLE_BOOK_NAME;
        $this->service->insertRow($str, $bookName);
        // Inserting the same text twice
        $this->service->insertRow($str, $bookName);

        $bookRows = $this->getAllBooks();

        $this->assertCount(1, $bookRows);
        $this->assertEquals($str, $bookRows[0]['one_row']);


    }

    /**
     * @test
     */
    public function canAddAnotherText(): void
    {
        $firstText  = file_get_contents('./fixtures/SampleBigText.txt');
        $secondText = file_get_contents('./fixtures/AnotherText.txt');
        $bookName   = BookServiceInterface::SAMPLE_BOOK_NAME;

        $this->service->insertRow($firstText, $bookName);
        $this->service->insertRow($secondText, $bookName);

        $bookRows = $this->getAllBooks();

        $this->assertCount(2, $bookRows);
        $this->assertEquals($firstText, $bookRows[0]['one_row']);
        $this->assertEquals($secondText, $bookRows[1]['one_row']);

    }
}
