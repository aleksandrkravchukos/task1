<?php


namespace Sample\Repository;

use PDO;

class BookRepository
{
    /**
     * @var PDO
     */
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * Delete all rows from database content and table book.
     */
    public function truncate()
    {
        $query = "TRUNCATE `book`";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
    }

    /**
     * @param string $str
     * @param string $bookName
     * @return bool
     */
    public function insertRow(string $str, string $bookName)
    {
        $hash = md5($str);
        $query = "INSERT INTO `book` (`name`, `one_row`,`hash_text`) VALUES (:name, :one_row, :hash_text)";
        $params = [
            ':name' => $bookName,
            ':one_row' => $str,
            ':hash_text' => $hash
        ];

        $stmt = $this->pdo->prepare($query);

        $stmt->execute($params);

        return true;
    }

    /**
     * @return array
     */
    public function getAll()
    {
        return $this->pdo->query('SELECT * FROM book')
            ->fetchAll(PDO::FETCH_ASSOC);
    }
}