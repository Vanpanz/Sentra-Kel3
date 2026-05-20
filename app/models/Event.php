<?php

namespace App\Models;

use App\Core\Database;

class Event
{
    private Database $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getLatest(): ?array
    {
        $sql = "SELECT * FROM events ORDER BY id DESC LIMIT 1";
        return $this->db->fetch($sql);
    }

    public function getRecent(int $limit = 6): array
    {
        $sql = "SELECT * FROM events ORDER BY id DESC LIMIT ?";
        return $this->db->fetchAll($sql, 'i', [$limit]);
    }

    public function countAll(): int
    {
        $row = $this->db->fetch("SELECT COUNT(*) AS total FROM events");
        return (int) ($row['total'] ?? 0);
    }

    public function findById(int $id): ?array
    {
        $sql = "SELECT * FROM events WHERE id = ?";
        return $this->db->fetch($sql, 'i', [$id]);
    }

    public function create(array $data): int
    {
        $sql = "INSERT INTO events (title, description, banner_path, created_by, location, start_date, end_date, capacity, status)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, 'ongoing')";

        $this->db->execute($sql, 'sssisssi', [
            $data['title'],
            $data['description'],
            $data['banner_path'],
            $data['created_by'],
            $data['location'],
            $data['start_date'],
            $data['end_date'],
            $data['capacity']
        ]);

        return $this->db->lastInsertId();
    }

    public function update(int $id, array $data): bool
    {
        $sql = "UPDATE events SET title = ?, description = ?, banner_path = ?, location = ?, start_date = ?, end_date = ?, capacity = ? WHERE id = ?";
        return $this->db->execute($sql, 'ssssssii', [
            $data['title'],
            $data['description'],
            $data['banner_path'],
            $data['location'],
            $data['start_date'],
            $data['end_date'],
            $data['capacity'],
            $id
        ]);
    }

    public function delete(int $id): bool
    {
        $sql = "DELETE FROM events WHERE id = ?";
        return $this->db->execute($sql, 'i', [$id]);
    }

    public function updateStatus(int $id, string $status): bool
    {
        $sql = "UPDATE events SET status = ? WHERE id = ?";
        return $this->db->execute($sql, 'si', [$status, $id]);
    }

    public function getCapacityInfo(int $eventId): ?array
    {
        $sql = "SELECT 
                    e.id, 
                    e.capacity, 
                    COUNT(er.id) as registered_count
                FROM events e
                LEFT JOIN event_registrations er ON e.id = er.event_id AND er.status != 'cancelled'
                WHERE e.id = ?
                GROUP BY e.id, e.capacity";
        return $this->db->fetch($sql, 'i', [$eventId]);
    }
}
