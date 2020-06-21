<?php declare(strict_types=1);


namespace Sample\Repository;

use PDO;

class BookRepository implements BookRepositoryInterface
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
     * @param string $str
     * @param string $bookName
     *
     * @return bool
     */
    public function insertRow(string $str, string $bookName): bool
    {
        $hash   = md5($str);
        $query  = "INSERT INTO `book` (`name`, `one_row`,`hash_text`) VALUES (:name, :one_row, :hash_text)";
        $params = [
            ':name'      => $bookName,
            ':one_row'   => $str,
            ':hash_text' => $hash
        ];

        $stmt = $this->pdo->prepare($query);

        $stmt->execute($params);

        return true;
    }
}
