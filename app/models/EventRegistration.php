<?php
namespace App\Models;

require_once '../app/core/Database.php';

use App\Core\Database;

class EventRegistration extends Database
{
    protected $table = 'event_registrations';

    // =========================================================================
    // GET METHODS
    // =========================================================================

    /**
     * Mendapatkan semua registrasi
     * @return array Daftar registrasi
     */
    public function getRegistrations()
    {
        $registrations = [];
        $query = "SELECT er.*, 
                         e.title as event_title, e.event_date,
                         u.name as user_name, u.email as user_email
                  FROM {$this->table} er
                  JOIN events e ON er.event_id = e.id
                  JOIN users u ON er.user_id = u.id
                  ORDER BY er.registered_at DESC";
        
        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();

        while ($registration = $result->fetch_assoc()) {
            $registrations[] = $registration;
        }

        return $registrations;
    }

    /**
     * Mendapatkan registrasi berdasarkan ID
     * @param int $id Registration ID
     * @return array|null Registrasi data
     */
    public function getRegistration(int $id)
    {
        $query = "SELECT er.*, 
                         e.title as event_title, e.event_date,
                         u.name as user_name, u.email as user_email
                  FROM {$this->table} er
                  JOIN events e ON er.event_id = e.id
                  JOIN users u ON er.user_id = u.id
                  WHERE er.id = ?";
        
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();

        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    /**
     * Mendapatkan peserta per event
     * @param int $event_id Event ID
     * @param string $status Filter berdasarkan status registrasi (optional)
     * @return array Daftar peserta
     */
    public function getRegistrationsByEvent(int $event_id, string $status = null)
    {
        $registrations = [];
        
        if ($status) {
            $query = "SELECT er.*, u.name, u.email, u.class
                     FROM {$this->table} er
                     JOIN users u ON er.user_id = u.id
                     WHERE er.event_id = ? AND er.registration_status = ?
                     ORDER BY er.registered_at DESC";
            $stmt = $this->connection->prepare($query);
            $stmt->bind_param("is", $event_id, $status);
        } else {
            $query = "SELECT er.*, u.name, u.email, u.class
                     FROM {$this->table} er
                     JOIN users u ON er.user_id = u.id
                     WHERE er.event_id = ?
                     ORDER BY er.registered_at DESC";
            $stmt = $this->connection->prepare($query);
            $stmt->bind_param("i", $event_id);
        }
        
        $stmt->execute();
        $result = $stmt->get_result();

        while ($registration = $result->fetch_assoc()) {
            $registrations[] = $registration;
        }

        return $registrations;
    }

    /**
     * Mendapatkan event yang diikuti user
     * @param int $user_id User ID
     * @return array Event yang diikuti user
     */
    public function getRegistrationsByUser(int $user_id)
    {
        $registrations = [];
        $query = "SELECT er.*, 
                         e.id as event_id, e.title as event_title, e.event_date, 
                         e.location, e.image_url, e.status as event_status
                  FROM {$this->table} er
                  JOIN events e ON er.event_id = e.id
                  WHERE er.user_id = ?
                  ORDER BY e.event_date DESC";
        
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();

        $result = $stmt->get_result();
        while ($registration = $result->fetch_assoc()) {
            $registrations[] = $registration;
        }

        return $registrations;
    }

    /**
     * Mengecek apakah user sudah terdaftar pada event
     * @param int $event_id Event ID
     * @param int $user_id User ID
     * @return bool|array False jika belum terdaftar, atau data registrasi jika sudah
     */
    public function isUserRegistered(int $event_id, int $user_id)
    {
        $query = "SELECT * FROM {$this->table} 
                 WHERE event_id = ? AND user_id = ?";
        
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("ii", $event_id, $user_id);
        $stmt->execute();

        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    /**
     * Mendapatkan riwayat keikutsertaan user
     * @param int $user_id User ID
     * @return array Riwayat keikutsertaan
     */
    public function getUserParticipationHistory(int $user_id)
    {
        $history = [];
        $query = "SELECT er.*, 
                         e.title as event_title, e.event_date, e.category, e.location
                  FROM {$this->table} er
                  JOIN events e ON er.event_id = e.id
                  WHERE er.user_id = ? AND e.status IN ('completed', 'ongoing')
                  ORDER BY e.event_date DESC";
        
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();

        $result = $stmt->get_result();
        while ($record = $result->fetch_assoc()) {
            $history[] = $record;
        }

        return $history;
    }

    // =========================================================================
    // CREATE METHODS
    // =========================================================================

    /**
     * Menambahkan registrasi baru
     * @param array $data Data registrasi
     * @return array Result dengan status dan message
     */
    public function insert(array $data)
    {
        $event_id = intval($data['event_id']);
        $user_id = intval($data['user_id']);
        $student_name = htmlspecialchars($data['student_name'] ?? '');
        $student_class = htmlspecialchars($data['student_class'] ?? '');
        $phone_number = htmlspecialchars($data['phone_number'] ?? '');
        $registration_status = $data['registration_status'] ?? 'pending';

        // Check if already registered
        $existing = $this->isUserRegistered($event_id, $user_id);
        if ($existing) {
            return ['success' => false, 'error' => 'User sudah terdaftar pada event ini'];
        }

        $query = "INSERT INTO {$this->table} 
                 (event_id, user_id, student_name, student_class, phone_number, registration_status) 
                 VALUES (?, ?, ?, ?, ?, ?)";
        
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param(
            'iissss',
            $event_id,
            $user_id,
            $student_name,
            $student_class,
            $phone_number,
            $registration_status
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
     * Update registrasi
     * @param array $data Data yang akan diupdate
     * @param int $id Registration ID
     * @return array Result
     */
    public function update(array $data, int $id)
    {
        $student_name = htmlspecialchars($data['student_name'] ?? '');
        $student_class = htmlspecialchars($data['student_class'] ?? '');
        $phone_number = htmlspecialchars($data['phone_number'] ?? '');
        $registration_status = $data['registration_status'] ?? 'pending';
        $notes = htmlspecialchars($data['notes'] ?? '');

        $query = "UPDATE {$this->table} 
                 SET student_name = ?, student_class = ?, phone_number = ?, 
                     registration_status = ?, notes = ? 
                 WHERE id = ?";
        
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param(
            'sssssi',
            $student_name,
            $student_class,
            $phone_number,
            $registration_status,
            $notes,
            $id
        );

        if ($stmt->execute()) {
            return ['success' => true];
        } else {
            return ['success' => false, 'error' => $stmt->error];
        }
    }

    /**
     * Update status registrasi
     * @param int $id Registration ID
     * @param string $status Status baru (pending, confirmed, rejected, cancelled)
     * @return array Result
     */
    public function updateStatus(int $id, string $status)
    {
        $update_field = '';
        switch ($status) {
            case 'confirmed':
                $update_field = ', confirmed_at = NOW()';
                break;
            case 'present':
                $update_field = ', attendance_status = "present", attended_at = NOW()';
                break;
        }

        $query = "UPDATE {$this->table} SET registration_status = ?$update_field WHERE id = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("si", $status, $id);

        if ($stmt->execute()) {
            return ['success' => true];
        } else {
            return ['success' => false, 'error' => $stmt->error];
        }
    }

    /**
     * Update attendance
     * @param int $id Registration ID
     * @param string $attendance_status Status kehadiran (present, absent)
     * @return array Result
     */
    public function updateAttendance(int $id, string $attendance_status)
    {
        $query = "UPDATE {$this->table} 
                 SET attendance_status = ?, attended_at = NOW() 
                 WHERE id = ?";
        
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("si", $attendance_status, $id);

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
     * Menghapus registrasi
     * @param int $id Registration ID
     * @return array Result
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
    // STATISTICS METHODS
    // =========================================================================

    /**
     * Mendapatkan statistik event
     * @param int $event_id Event ID
     * @return array Statistik event
     */
    public function getEventStatistics(int $event_id)
    {
        $query = "SELECT 
                    COUNT(*) as total_registrations,
                    SUM(CASE WHEN registration_status = 'confirmed' THEN 1 ELSE 0 END) as confirmed,
                    SUM(CASE WHEN registration_status = 'pending' THEN 1 ELSE 0 END) as pending,
                    SUM(CASE WHEN registration_status = 'rejected' THEN 1 ELSE 0 END) as rejected,
                    SUM(CASE WHEN attendance_status = 'present' THEN 1 ELSE 0 END) as present,
                    SUM(CASE WHEN attendance_status = 'absent' THEN 1 ELSE 0 END) as absent
                 FROM {$this->table} 
                 WHERE event_id = ?";
        
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("i", $event_id);
        $stmt->execute();

        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    /**
     * Mendapatkan statistik peserta per kategori
     * @return array Statistik kategori
     */
    public function getParticipationStatistics()
    {
        $stats = [];
        $query = "SELECT 
                    e.category,
                    COUNT(er.id) as total_registrations,
                    COUNT(DISTINCT er.user_id) as unique_participants
                 FROM {$this->table} er
                 JOIN events e ON er.event_id = e.id
                 GROUP BY e.category
                 ORDER BY total_registrations DESC";
        
        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();

        while ($stat = $result->fetch_assoc()) {
            $stats[] = $stat;
        }

        return $stats;
    }
}
?>
