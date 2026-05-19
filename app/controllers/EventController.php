<?php
namespace App\Controllers;

require_once '../app/core/Controller.php';
require_once '../app/models/Event.php';
require_once '../app/models/EventRegistration.php';
require_once '../app/models/User.php';

use App\Core\Controller;
use App\Models\Event;
use App\Models\EventRegistration;
use App\Models\User;

class EventController extends Controller
{
    protected $eventModel;
    protected $registrationModel;
    protected $userModel;

    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $this->eventModel = new Event();
        $this->registrationModel = new EventRegistration();
        $this->userModel = new User();
    }

    // =========================================================================
    // HOME & PUBLIC PAGES
    // =========================================================================

    /**
     * Halaman homepage - tampilkan daftar event
     */
    public function index()
    {
        $events = $this->eventModel->getEventsWithCount();

        $this->view('events.index', [
            'events' => $events,
            'page_title' => 'Daftar Event'
        ]);
    }

    /**
     * Halaman tentang sekolah
     */
    public function about()
    {
        $this->view('pages.about', [
            'page_title' => 'Tentang Kami'
        ]);
    }

    /**
     * Halaman profil user
     */
    public function profile()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: /login');
            exit;
        }

        $user = $this->userModel->getUser($_SESSION['user']['id']);

        $this->view('pages.profile', [
            'user' => $user,
            'page_title' => 'Profil Saya'
        ]);
    }

    // =========================================================================
    // EVENT CRUD - READ
    // =========================================================================

    /**
     * Tampilkan detail event
     * @param int $id Event ID
     */
    public function show(int $id)
    {
        $event = $this->eventModel->getEvent($id);

        if (!$event) {
            http_response_code(404);
            echo '<h1>Event tidak ditemukan</h1>';
            exit;
        }

        $isRegistered = false;
        $registration = null;

        if (isset($_SESSION['user'])) {
            $registration = $this->registrationModel->isUserRegistered(
                $event['id'],
                $_SESSION['user']['id']
            );
            $isRegistered = $registration ? true : false;
        }

        $participants = $this->registrationModel->getRegistrationsByEvent($event['id'], 'confirmed');
        $stats = $this->registrationModel->getEventStatistics($event['id']);

        $this->view('events.detail', [
            'event' => $event,
            'isRegistered' => $isRegistered,
            'registration' => $registration,
            'participants' => $participants,
            'stats' => $stats,
            'page_title' => $event['title']
        ]);
    }

    // =========================================================================
    // EVENT CRUD - CREATE
    // =========================================================================

    /**
     * Form create event
     */
    public function create()
    {
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            header('Location: /login');
            exit;
        }

        $this->view('events.create', [
            'page_title' => 'Buat Event Baru'
        ]);
    }

    /**
     * Process create event
     */
    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            exit;
        }

        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            header('Location: /login');
            exit;
        }

        $data = [
            'title' => $_POST['title'] ?? '',
            'description' => $_POST['description'] ?? '',
            'category' => $_POST['category'] ?? '',
            'location' => $_POST['location'] ?? '',
            'event_date' => $_POST['event_date'] ?? '',
            'event_time' => $_POST['event_time'] ?? '00:00:00',
            'end_date' => $_POST['end_date'] ?? $_POST['event_date'] ?? '',
            'end_time' => $_POST['end_time'] ?? '23:59:59',
            'quota' => $_POST['quota'] ?? 0,
            'status' => $_POST['status'] ?? 'draft',
            'organizer_id' => $_SESSION['user']['id']
        ];

        // Handle file upload
        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            $image_url = $this->handleImageUpload($_FILES['image']);
            if ($image_url) {
                $data['image_url'] = $image_url;
            }
        }

        $result = $this->eventModel->insert($data);

        if ($result['success']) {
            header("Location: /events/{$result['id']}");
            exit;
        } else {
            echo "Error: " . $result['error'];
        }
    }

    // =========================================================================
    // EVENT CRUD - UPDATE
    // =========================================================================

    /**
     * Form edit event
     * @param int $id Event ID
     */
    public function edit(int $id)
    {
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            header('Location: /login');
            exit;
        }

        $event = $this->eventModel->getEvent($id);

        if (!$event) {
            http_response_code(404);
            exit;
        }

        $this->view('events.edit', [
            'event' => $event,
            'page_title' => 'Edit Event'
        ]);
    }

    /**
     * Process update event
     * @param int $id Event ID
     */
    public function update(int $id)
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            exit;
        }

        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            header('Location: /login');
            exit;
        }

        $event = $this->eventModel->getEvent($id);
        if (!$event) {
            http_response_code(404);
            exit;
        }

        $data = [
            'title' => $_POST['title'] ?? '',
            'description' => $_POST['description'] ?? '',
            'category' => $_POST['category'] ?? '',
            'location' => $_POST['location'] ?? '',
            'event_date' => $_POST['event_date'] ?? '',
            'event_time' => $_POST['event_time'] ?? '00:00:00',
            'end_date' => $_POST['end_date'] ?? $_POST['event_date'] ?? '',
            'end_time' => $_POST['end_time'] ?? '23:59:59',
            'quota' => $_POST['quota'] ?? 0,
            'status' => $_POST['status'] ?? 'draft',
            'image_url' => $event['image_url']
        ];

        // Handle file upload
        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            $image_url = $this->handleImageUpload($_FILES['image']);
            if ($image_url) {
                $data['image_url'] = $image_url;
            }
        }

        $result = $this->eventModel->update($data, $id);

        if ($result['success']) {
            header("Location: /events/$id");
            exit;
        } else {
            echo "Error: " . $result['error'];
        }
    }

    // =========================================================================
    // EVENT CRUD - DELETE
    // =========================================================================

    /**
     * Process delete event
     * @param int $id Event ID
     */
    public function destroy(int $id)
    {
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            header('Location: /login');
            exit;
        }

        $result = $this->eventModel->delete($id);

        if ($result['success']) {
            header('Location: /');
            exit;
        } else {
            echo "Error: " . $result['error'];
        }
    }

    // =========================================================================
    // REGISTRATION METHODS
    // =========================================================================

    /**
     * Register user ke event
     */
    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            exit;
        }

        if (!isset($_SESSION['user'])) {
            header('Location: /login');
            exit;
        }

        $event_id = intval($_POST['event_id'] ?? 0);
        $user = $this->userModel->getUser($_SESSION['user']['id']);

        if (!$event_id || !$user) {
            echo json_encode(['success' => false, 'error' => 'Data tidak valid']);
            exit;
        }

        // Check event exists
        $event = $this->eventModel->getEvent($event_id);
        if (!$event) {
            echo json_encode(['success' => false, 'error' => 'Event tidak ditemukan']);
            exit;
        }

        // Check if full
        if ($this->eventModel->isEventFull($event_id)) {
            echo json_encode(['success' => false, 'error' => 'Event sudah penuh']);
            exit;
        }

        $data = [
            'event_id' => $event_id,
            'user_id' => $user['id'],
            'student_name' => $user['name'],
            'student_class' => $user['class'],
            'phone_number' => $user['phone_number'],
            'registration_status' => 'pending'
        ];

        $result = $this->registrationModel->insert($data);

        if ($result['success']) {
            echo json_encode(['success' => true, 'message' => 'Berhasil mendaftar event']);
        } else {
            echo json_encode(['success' => false, 'error' => $result['error']]);
        }
    }

    /**
     * Cancel registration
     */
    public function cancelRegistration(int $id)
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            exit;
        }

        if (!isset($_SESSION['user'])) {
            header('Location: /login');
            exit;
        }

        $registration = $this->registrationModel->getRegistration($id);

        if (!$registration || $registration['user_id'] != $_SESSION['user']['id']) {
            echo json_encode(['success' => false, 'error' => 'Tidak diizinkan']);
            exit;
        }

        $result = $this->registrationModel->updateStatus($id, 'cancelled');

        if ($result['success']) {
            echo json_encode(['success' => true, 'message' => 'Registrasi dibatalkan']);
        } else {
            echo json_encode(['success' => false, 'error' => $result['error']]);
        }
    }

    /**
     * Tampilkan registrasi per event (admin)
     * @param int $id Event ID
     */
    public function registrations(int $id)
    {
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            header('Location: /login');
            exit;
        }

        $event = $this->eventModel->getEvent($id);
        if (!$event) {
            http_response_code(404);
            exit;
        }

        $registrations = $this->registrationModel->getRegistrationsByEvent($id);
        $stats = $this->registrationModel->getEventStatistics($id);

        $this->view('registrations.index', [
            'event' => $event,
            'registrations' => $registrations,
            'stats' => $stats,
            'page_title' => "Daftar Peserta - {$event['title']}"
        ]);
    }

    /**
     * Update registration status (admin)
     */
    public function updateRegistration(int $id)
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            exit;
        }

        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            echo json_encode(['success' => false, 'error' => 'Tidak diizinkan']);
            exit;
        }

        $status = $_POST['status'] ?? '';
        $result = $this->registrationModel->updateStatus($id, $status);

        if ($result['success']) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => $result['error']]);
        }
    }

    // =========================================================================
    // USER PAGES
    // =========================================================================

    /**
     * Halaman login
     */
    public function login()
    {
        if (isset($_SESSION['user'])) {
            header('Location: /');
            exit;
        }

        $this->view('auth.login', [
            'page_title' => 'Login'
        ]);
    }

    /**
     * Process login
     */
    public function loginProcess()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            exit;
        }

        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        $result = $this->userModel->login($email, $password);

        if ($result['success']) {
            $_SESSION['user'] = $result['user'];
            header('Location: /');
            exit;
        } else {
            $this->view('auth.login', [
                'error' => $result['error'],
                'page_title' => 'Login'
            ]);
        }
    }

    /**
     * Halaman register
     */
    public function register_page()
    {
        if (isset($_SESSION['user'])) {
            header('Location: /');
            exit;
        }

        $this->view('auth.register', [
            'page_title' => 'Daftar'
        ]);
    }

    /**
     * Process register
     */
    public function registerProcess()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            exit;
        }

        $data = [
            'name' => $_POST['name'] ?? '',
            'email' => $_POST['email'] ?? '',
            'password' => $_POST['password'] ?? '',
            'confirm_password' => $_POST['confirm_password'] ?? '',
            'phone_number' => $_POST['phone_number'] ?? '',
            'class' => $_POST['class'] ?? '',
            'role' => 'student'
        ];

        $result = $this->userModel->register($data);

        if ($result['success']) {
            // Auto login after register
            $user = $this->userModel->getUser($result['id']);
            $_SESSION['user'] = $user;
            header('Location: /');
            exit;
        } else {
            $this->view('auth.register', [
                'error' => $result['error'],
                'page_title' => 'Daftar'
            ]);
        }
    }

    /**
     * Logout
     */
    public function logout()
    {
        session_destroy();
        header('Location: /');
        exit;
    }

    // =========================================================================
    // UTILITY METHODS
    // =========================================================================

    /**
     * Handle image upload
     * @param array $file File from $_FILES
     * @return string|null Image URL atau null
     */
    private function handleImageUpload($file)
    {
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        $maxSize = 5 * 1024 * 1024; // 5MB

        if (!in_array($file['type'], $allowedTypes)) {
            return null;
        }

        if ($file['size'] > $maxSize) {
            return null;
        }

        $uploadDir = __DIR__ . '/../../public/assets/foto/';
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        // Generate unique filename with snake-case
        $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
        $filename = time() . '_' . strtolower(str_replace(' ', '-', pathinfo($file['name'], PATHINFO_FILENAME))) . '.' . $ext;
        $filepath = $uploadDir . $filename;

        if (move_uploaded_file($file['tmp_name'], $filepath)) {
            return "assets/foto/" . $filename;
        }

        return null;
    }

    /**
     * Search events
     */
    public function search()
    {
        $keyword = $_GET['q'] ?? '';

        if (empty($keyword)) {
            header('Location: /');
            exit;
        }

        $events = $this->eventModel->search($keyword);

        $this->view('events.search', [
            'events' => $events,
            'keyword' => $keyword,
            'page_title' => "Hasil Pencarian: {$keyword}"
        ]);
    }
}
?>
