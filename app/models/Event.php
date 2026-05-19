<?php
namespace App\Models;

require_once '../app/core/Database.php';

use App\Core\Database;

class Event extends Database
{
    protected $table = 'events';

    // =========================================================================
    // GET METHODS
    // =========================================================================

    /**
     * Mendapatkan semua event dengan filter optional
     * @param string $status Filter berdasarkan status (optional)
     * @return array Daftar event
     */
    public function getEvents(string $status = null)
    {
        $events = [];
        
        if ($status) {
            $query = "SELECT * FROM {$this->table} WHERE status = ? ORDER BY event_date DESC";
            $stmt = $this->connection->prepare($query);
            $stmt->bind_param("s", $status);
        } else {
            $query = "SELECT * FROM {$this->table} ORDER BY event_date DESC";
            $stmt = $this->connection->prepare($query);
        }
        
        $stmt->execute();
        $result = $stmt->get_result();

        while ($event = $result->fetch_assoc()) {
            $events[] = $event;
        }

        return $events;
    }

    /**
     * Mendapatkan event berdasarkan ID
     * @param int $id Event ID
     * @return array|null Event data atau null jika tidak ditemukan
     */
    public function getEvent(int $id)
    {
        $query = "SELECT * FROM {$this->table} WHERE id = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();

        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    /**
     * Mendapatkan event berdasarkan organizer/pembuat
     * @param int $organizer_id User ID pembuat event
     * @return array Daftar event milik organizer
     */
    public function getEventsByOrganizer(int $organizer_id)
    {
        $events = [];
        $query = "SELECT * FROM {$this->table} WHERE organizer_id = ? ORDER BY created_at DESC";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("i", $organizer_id);
        $stmt->execute();

        $result = $stmt->get_result();
        while ($event = $result->fetch_assoc()) {
            $events[] = $event;
        }

        return $events;
    }

    /**
     * Mendapatkan event dengan registrations count
     * @return array Event dengan informasi jumlah peserta
     */
    public function getEventsWithCount()
    {
        $events = [];
        $query = "SELECT e.*, 
                         COUNT(er.id) as registered_count,
                         e.quota,
                         (e.quota - COUNT(er.id)) as available_slots
                  FROM {$this->table} e
                  LEFT JOIN event_registrations er ON e.id = er.event_id
                  WHERE er.registration_status IN ('confirmed', 'pending') OR er.id IS NULL
                  GROUP BY e.id
                  ORDER BY e.event_date DESC";
        
        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();

        while ($event = $result->fetch_assoc()) {
            $events[] = $event;
        }

        return $events;
    }

    /**
     * Mendapatkan event yang sedang berlangsung
     * @return array Event dengan status ongoing
     */
    public function getOngoingEvents()
    {
        return $this->getEvents('ongoing');
    }

    /**
     * Mendapatkan event yang sudah selesai
     * @return array Event dengan status completed
     */
    public function getCompletedEvents()
    {
        return $this->getEvents('completed');
    }

    // =========================================================================
    // CREATE METHODS
    // =========================================================================

    /**
     * Menambahkan event baru
     * @param array $data Data event (title, description, category, location, event_date, event_time, end_date, end_time, quota, image_url, organizer_id)
     * @return bool Status penambahan
     */
    public function insert(array $data)
    {
        $title = htmlspecialchars($data['title']);
        $description = htmlspecialchars($data['description']);
        $category = htmlspecialchars($data['category'] ?? '');
        $location = htmlspecialchars($data['location'] ?? '');
        $event_date = $data['event_date'];
        $event_time = $data['event_time'] ?? '00:00:00';
        $end_date = $data['end_date'] ?? $event_date;
        $end_time = $data['end_time'] ?? '23:59:59';
        $quota = intval($data['quota'] ?? 0);
        $image_url = $data['image_url'] ?? null;
        $organizer_id = intval($data['organizer_id']);
        $status = $data['status'] ?? 'draft';

        $query = "INSERT INTO {$this->table} 
                 (title, description, category, location, event_date, event_time, end_date, end_time, quota, image_url, organizer_id, status) 
                 VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param(
            'ssssssssiiis',
            $title,
            $description,
            $category,
            $location,
            $event_date,
            $event_time,
            $end_date,
            $end_time,
            $quota,
            $image_url,
            $organizer_id,
            $status
        );

        if ($stmt->execute()) {
            return ['success' => true, 'id' => $this->connection->insert_id];
        } else {
            return ['success' => false, 'error' => $stmt->error];
        }
    }

    // =========================================================================
    // UPDATE METHODS
    // =========================================================================

    /**
     * Mengupdate event
     * @param array $data Data yang akan diupdate
     * @param int $id Event ID
     * @return bool Status update
     */
    public function update(array $data, int $id)
    {
        $title = htmlspecialchars($data['title']);
        $description = htmlspecialchars($data['description']);
        $category = htmlspecialchars($data['category'] ?? '');
        $location = htmlspecialchars($data['location'] ?? '');
        $event_date = $data['event_date'];
        $event_time = $data['event_time'] ?? '00:00:00';
        $end_date = $data['end_date'] ?? $event_date;
        $end_time = $data['end_time'] ?? '23:59:59';
        $quota = intval($data['quota'] ?? 0);
        $image_url = $data['image_url'] ?? null;
        $status = $data['status'] ?? 'draft';

        $query = "UPDATE {$this->table} 
                 SET title = ?, description = ?, category = ?, location = ?, 
                     event_date = ?, event_time = ?, end_date = ?, end_time = ?, 
                     quota = ?, image_url = ?, status = ? 
                 WHERE id = ?";
        
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param(
            'ssssssssiisi',
            $title,
            $description,
            $category,
            $location,
            $event_date,
            $event_time,
            $end_date,
            $end_time,
            $quota,
            $image_url,
            $status,
            $id
        );

        if ($stmt->execute()) {
            return ['success' => true];
        } else {
            return ['success' => false, 'error' => $stmt->error];
        }
    }

    /**
     * Update status event
     * @param int $id Event ID
     * @param string $status Status baru (draft, published, ongoing, completed, cancelled)
     * @return bool Status update
     */
    public function updateStatus(int $id, string $status)
    {
        $query = "UPDATE {$this->table} SET status = ? WHERE id = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("si", $status, $id);

        if ($stmt->execute()) {
            return ['success' => true];
        } else {
            return ['success' => false, 'error' => $stmt->error];
        }
    }

    // =========================================================================
    // DELETE METHODS
    // =========================================================================

    /**
     * Menghapus event
     * @param int $id Event ID
     * @return bool Status penghapusan
     */
    public function delete(int $id)
    {
        $query = "DELETE FROM {$this->table} WHERE id = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            return ['success' => true];
        } else {
            return ['success' => false, 'error' => $stmt->error];
        }
    }

    // =========================================================================
    // UTILITY METHODS
    // =========================================================================

    /**
     * Mengecek apakah event sudah penuh
     * @param int $id Event ID
     * @return bool True jika penuh
     */
    public function isEventFull(int $id)
    {
        $event = $this->getEvent($id);
        if (!$event) return true;

        if ($event['quota'] <= 0) return false; // No quota limit

        $query = "SELECT COUNT(*) as count FROM event_registrations 
                 WHERE event_id = ? AND registration_status IN ('confirmed', 'pending')";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();

        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        return $row['count'] >= $event['quota'];
    }

    /**
     * Mendapatkan jumlah peserta terdaftar
     * @param int $id Event ID
     * @return int Jumlah peserta
     */
    public function getRegistrationCount(int $id)
    {
        $query = "SELECT COUNT(*) as count FROM event_registrations 
                 WHERE event_id = ? AND registration_status = 'confirmed'";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();

        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        return intval($row['count']);
    }

    /**
     * Pencarian event
     * @param string $keyword Keyword pencarian
     * @return array Hasil pencarian
     */
    public function search(string $keyword)
    {
        $events = [];
        $search = "%$keyword%";
        
        $query = "SELECT * FROM {$this->table} 
                 WHERE title LIKE ? OR description LIKE ? OR category LIKE ?
                 ORDER BY event_date DESC";
        
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("sss", $search, $search, $search);
        $stmt->execute();

        $result = $stmt->get_result();
        while ($event = $result->fetch_assoc()) {
            $events[] = $event;
        }

        return $events;
    }
}
?>
