<?php

namespace App\Models;

use App\Core\Database;

class User
{
    private Database $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function findByEmail(string $email): ?array
    {
        $sql = "SELECT * FROM users WHERE email = ? LIMIT 1";
        return $this->db->fetch($sql, 's', [$email]);
    }

    public function findById(int $id): ?array
    {
        $sql = "SELECT * FROM users WHERE id = ?";
        return $this->db->fetch($sql, 'i', [$id]);
    }

    public function create(array $data): int
    {
        $sql = "INSERT INTO users (name, email, password, role)
                VALUES (?, ?, ?, ?)";

        $this->db->execute($sql, 'ssss', [
            $data['name'],
            $data['email'],
            $data['password'],
            $data['role']
        ]);

        return $this->db->lastInsertId();
    }

    public function countAll(): int
    {
        $row = $this->db->fetch("SELECT COUNT(*) AS total FROM users");
        return (int) ($row['total'] ?? 0);
    }
}
