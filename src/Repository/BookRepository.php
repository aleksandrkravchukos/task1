<?php


namespace Sample\Repository;


use Exception;
use PDO;
use function PHPUnit\Framework\assertNotTrue;
use Sample\Config\ConfigClass;

class BookRepository
{

    /**
     * @var ConfigClass
     */
    private $config;

    /**
     * @var PDO
     */
    private $pdo;

    /**
     * RepositoryClass constructor.
     * @param ConfigClass $config
     */
    public function __construct(ConfigClass $config)
    {
        $this->config = $config;
        $this->pdo = new PDO($this->config->getDsn(), $this->config->getUserName(), $this->config->getPassword());
    }

    /**
     * Delete all rows from database content and table book.
     */
    public function deleteAll()
    {
        $query = "DELETE FROM `book`";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
    }

    /**
     * @param string $str
     * @return bool
     */
    public function insertRow(string $str)
    {
        echo PHP_EOL . 'Inserting Row - ';

        $bookName = 'New book';
        $hash = md5($str);
        $query = "INSERT INTO `book` (`name`, `one_row`,`hash_text`) VALUES (:name, :one_row, :hash_text)";
        $params = [
            ':name' => $bookName,
            ':one_row' => $str,
            ':hash_text' => $hash
        ];

        $stmt = $this->pdo->prepare($query);
        $success = false;

        try {
            $success = $stmt->execute($params);
        } catch (Exception $exception) {

        }

        var_dump($success);

        return $success;
    }

    /**
     * @return array
     */
    public function getAll()
    {
        $stm = $this->pdo->query('SELECT * FROM book')->fetchAll(PDO::FETCH_ASSOC);
        $result = [];
        foreach ($stm as $key => $value) {
            $result[] = $value['one_row'];
        }

        return $result;
    }
}