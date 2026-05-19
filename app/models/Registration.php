<?php

namespace App\Models;

use App\Core\Database;

class Registration
{
    private Database $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function register(int $eventId, int $userId): bool
    {
        $sql = "INSERT INTO event_registrations (event_id, user_id, status)
                VALUES (?, ?, 'registered')";
        return $this->db->execute($sql, 'ii', [$eventId, $userId]);
    }

    public function exists(int $eventId, int $userId): bool
    {
        $sql = "SELECT id FROM event_registrations WHERE event_id = ? AND user_id = ? LIMIT 1";
        return $this->db->fetch($sql, 'ii', [$eventId, $userId]) !== null;
    }

    public function countByEvent(int $eventId): int
    {
        $row = $this->db->fetch(
            "SELECT COUNT(*) AS total FROM event_registrations WHERE event_id = ?",
            'i',
            [$eventId]
        );

        return (int) ($row['total'] ?? 0);
    }

    public function listByEvent(int $eventId): array
    {
        $sql = "SELECT er.*, u.name, u.email
                FROM event_registrations er
                JOIN users u ON u.id = er.user_id
                WHERE er.event_id = ?
                ORDER BY er.created_at DESC";
        return $this->db->fetchAll($sql, 'i', [$eventId]);
    }

    public function listByUser(int $userId): array
    {
        $sql = "SELECT er.*, e.title
                FROM event_registrations er
                JOIN events e ON e.id = er.event_id
                WHERE er.user_id = ?
                ORDER BY er.created_at DESC";
        return $this->db->fetchAll($sql, 'i', [$userId]);
    }
}
