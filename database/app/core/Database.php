<?php
namespace App\Core;

class Database
{

    protected \mysqli $connection;

    public function __construct()
    {
        require_once '../app/config/app.php';

        $this->connection = mysqli_connect(
            DB_HOST,
            DB_USER,
            DB_PASSWORD,
            DB_NAME
        );

        if (!$this->connection) {
            die('Error to connect Database: ' . mysqli_connect_error());
        }

        mysqli_set_charset($this->connection, 'utf8mb4');
    }

    public function prepare(string $sql): \mysqli_stmt
    {
        $stmt = mysqli_prepare($this->connection, $sql);
        if (!$stmt) {
            die('Failed to prepare statement: ' . mysqli_error($this->connection));
        }

        return $stmt;
    }

    public function fetch(string $sql, string $types = '', array $params = []): ?array
    {
        $stmt = $this->prepare($sql);

        if ($types !== '') {
            $stmt->bind_param($types, ...$params);
        }

        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result ? $result->fetch_assoc() : null;
        $stmt->close();

        return $row ?: null;
    }

    public function fetchAll(string $sql, string $types = '', array $params = []): array
    {
        $stmt = $this->prepare($sql);

        if ($types !== '') {
            $stmt->bind_param($types, ...$params);
        }

        $stmt->execute();
        $result = $stmt->get_result();
        $rows = $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
        $stmt->close();

        return $rows;
    }

    public function execute(string $sql, string $types = '', array $params = []): bool
    {
        $stmt = $this->prepare($sql);

        if ($types !== '') {
            $stmt->bind_param($types, ...$params);
        }

        $success = $stmt->execute();
        $stmt->close();

        return $success;
    }

    public function lastInsertId(): int
    {
        return (int) $this->connection->insert_id;
    }

}


?>