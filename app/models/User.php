<?php
namespace App\Models;

require_once '../app/core/Database.php';

use App\Core\Database;

class User extends Database
{
    protected $table = 'users';

    // =========================================================================
    // GET METHODS
    // =========================================================================

    /**
     * Mendapatkan semua pengguna
     * @param string $role Filter berdasarkan role (optional)
     * @return array Daftar pengguna
     */
    public function getUsers(string $role = null)
    {
        $users = [];

        if ($role) {
            $query = "SELECT id, name, email, phone_number, class, role, created_at FROM {$this->table} WHERE role = ? AND is_active = 1";
            $stmt = $this->connection->prepare($query);
            $stmt->bind_param("s", $role);
        } else {
            $query = "SELECT id, name, email, phone_number, class, role, created_at FROM {$this->table} WHERE is_active = 1";
            $stmt = $this->connection->prepare($query);
        }

        $stmt->execute();
        $result = $stmt->get_result();

        while ($user = $result->fetch_assoc()) {
            $users[] = $user;
        }

        return $users;
    }

    /**
     * Mendapatkan pengguna berdasarkan ID
     * @param int $id User ID
     * @return array|null User data
     */
    public function getUser(int $id)
    {
        $query = "SELECT id, name, email, phone_number, class, role, profile_picture, bio, created_at FROM {$this->table} WHERE id = ? AND is_active = 1";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();

        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    /**
     * Mendapatkan pengguna berdasarkan email
     * @param string $email Email pengguna
     * @return array|null User data
     */
    public function getUserByEmail(string $email)
    {
        $query = "SELECT * FROM {$this->table} WHERE email = ? AND is_active = 1";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("s", $email);
        $stmt->execute();

        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    /**
     * Mendapatkan semua siswa
     * @return array Daftar siswa
     */
    public function getStudents()
    {
        return $this->getUsers('student');
    }

    /**
     * Mendapatkan semua guru
     * @return array Daftar guru
     */
    public function getTeachers()
    {
        return $this->getUsers('teacher');
    }

    // =========================================================================
    // CREATE METHODS
    // =========================================================================

    /**
     * Register pengguna baru
     * @param array $data Data pengguna (name, email, password, phone_number, class, role)
     * @return array Result dengan status dan message
     */
    public function register(array $data)
    {
        $name = htmlspecialchars(trim($data['name'] ?? ''));
        $email = htmlspecialchars(trim($data['email'] ?? ''));
        $password = $data['password'] ?? '';
        $confirmPassword = $data['confirm_password'] ?? '';
        $phone_number = htmlspecialchars($data['phone_number'] ?? '');
        $class = htmlspecialchars($data['class'] ?? '');
        $role = $data['role'] ?? 'student';

        // Validasi
        if (empty($name) || empty($email) || empty($password)) {
            return ['success' => false, 'error' => 'Semua field wajib diisi'];
        }

        if ($password !== $confirmPassword) {
            return ['success' => false, 'error' => 'Password tidak sama'];
        }

        // Check email
        $existing = $this->getUserByEmail($email);
        if ($existing) {
            return ['success' => false, 'error' => 'Email sudah digunakan'];
        }

        // Hash password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $query = "INSERT INTO {$this->table} 
                 (name, email, password, phone_number, class, role) 
                 VALUES (?, ?, ?, ?, ?, ?)";

        $stmt = $this->connection->prepare($query);
        $stmt->bind_param(
            'ssssss',
            $name,
            $email,
            $hashedPassword,
            $phone_number,
            $class,
            $role
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
     * Update profil pengguna
     * @param array $data Data yang akan diupdate
     * @param int $id User ID
     * @return array Result
     */
    public function update(array $data, int $id)
    {
        $name = htmlspecialchars(trim($data['name'] ?? ''));
        $phone_number = htmlspecialchars($data['phone_number'] ?? '');
        $class = htmlspecialchars($data['class'] ?? '');
        $bio = htmlspecialchars($data['bio'] ?? '');
        $profile_picture = $data['profile_picture'] ?? null;

        $query = "UPDATE {$this->table} 
                 SET name = ?, phone_number = ?, class = ?, bio = ?";
        
        $params = ['ssss', $name, $phone_number, $class, $bio];

        if ($profile_picture) {
            $query .= ", profile_picture = ?";
            $params[0] .= 's';
            $params[] = $profile_picture;
        }

        $query .= " WHERE id = ?";
        $params[0] .= 'i';
        $params[] = $id;

        $stmt = $this->connection->prepare($query);
        $stmt->bind_param(...$params);

        if ($stmt->execute()) {
            return ['success' => true];
        } else {
            return ['success' => false, 'error' => $stmt->error];
        }
    }

    /**
     * Update password pengguna
     * @param int $id User ID
     * @param string $oldPassword Password lama
     * @param string $newPassword Password baru
     * @return array Result
     */
    public function updatePassword(int $id, string $oldPassword, string $newPassword)
    {
        $user = $this->getUser($id);
        if (!$user) {
            return ['success' => false, 'error' => 'User tidak ditemukan'];
        }

        // Get user with password hash
        $query = "SELECT password FROM {$this->table} WHERE id = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        // Verify old password
        if (!password_verify($oldPassword, $user['password'])) {
            return ['success' => false, 'error' => 'Password lama tidak sesuai'];
        }

        // Hash new password
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        $query = "UPDATE {$this->table} SET password = ? WHERE id = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("si", $hashedPassword, $id);

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
     * Soft delete pengguna (set is_active = 0)
     * @param int $id User ID
     * @return array Result
     */
    public function delete(int $id)
    {
        $query = "UPDATE {$this->table} SET is_active = 0 WHERE id = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            return ['success' => true];
        } else {
            return ['success' => false, 'error' => $stmt->error];
        }
    }

    /**
     * Hard delete pengguna
     * @param int $id User ID
     * @return array Result
     */
    public function hardDelete(int $id)
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
    // AUTHENTICATION METHODS
    // =========================================================================

    /**
     * Login pengguna
     * @param string $email Email pengguna
     * @param string $password Password pengguna
     * @return array Result dengan user data jika berhasil
     */
    public function login(string $email, string $password)
    {
        $user = $this->getUserByEmail($email);

        if (!$user) {
            return ['success' => false, 'error' => 'Email atau password salah'];
        }

        if (!password_verify($password, $user['password'])) {
            return ['success' => false, 'error' => 'Email atau password salah'];
        }

        // Return user data tanpa password
        unset($user['password']);
        return ['success' => true, 'user' => $user];
    }

    // =========================================================================
    // UTILITY METHODS
    // =========================================================================

    /**
     * Mencari pengguna
     * @param string $keyword Keyword pencarian
     * @return array Hasil pencarian
     */
    public function search(string $keyword)
    {
        $users = [];
        $search = "%$keyword%";

        $query = "SELECT id, name, email, phone_number, class, role FROM {$this->table} 
                 WHERE (name LIKE ? OR email LIKE ? OR class LIKE ?) AND is_active = 1";

        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("sss", $search, $search, $search);
        $stmt->execute();

        $result = $stmt->get_result();
        while ($user = $result->fetch_assoc()) {
            $users[] = $user;
        }

        return $users;
    }

    /**
     * Mendapatkan jumlah pengguna per role
     * @return array Statistik role
     */
    public function getRoleStatistics()
    {
        $stats = [];
        $query = "SELECT role, COUNT(*) as count FROM {$this->table} WHERE is_active = 1 GROUP BY role";

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
