<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Event;
use App\Models\Registration;

class EventController extends Controller
{
    public function index()
    {
        $this->requireAuth();

        $eventModel = new Event();
        $ongoingEvent = $eventModel->getLatest();
        $events = $eventModel->getRecent(6);
        $totalEvents = $eventModel->countAll();

        $this->view('events.index', [
            'title' => 'Sentra - Dashboard',
            'userName' => $_SESSION['user']['name'] ?? 'Admin',
            'ongoingEvent' => $ongoingEvent,
            'events' => $events,
            'totalEvents' => $totalEvents,
            'isAdmin' => $this->isAdmin()
        ]);
    }

    public function create()
    {
        $this->requireRole('admin');

        $this->view('events.create', [
            'title' => 'Create Event'
        ], 'layouts.no-sidebar');
    }

    public function store()
    {
        $this->requireRole('admin');

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/events');
        }

        $title = trim($_POST['title'] ?? '');
        $description = trim($_POST['content'] ?? '');
        $location = trim($_POST['location'] ?? '');
        $startDate = $_POST['start_date'] ?? null;
        $endDate = $_POST['end_date'] ?? null;
        $capacity = $_POST['capacity'] ?? null;

        // Validasi dan format tanggal
        if ($startDate === '' || $startDate === null) {
            $startDate = null;
        } else {
            // Coba parse tanggal, validasi format YYYY-MM-DD
            $parsed = \DateTime::createFromFormat('Y-m-d', $startDate);
            if (!$parsed) {
                $this->view('events.create', [
                    'title' => 'Create Event',
                    'error' => 'Format tanggal mulai tidak valid. Gunakan format YYYY-MM-DD (contoh: 2026-02-11).'
                ]);
                return;
            }
            $startDate = $parsed->format('Y-m-d');
        }

        if ($endDate === '' || $endDate === null) {
            $endDate = null;
        } else {
            // Coba parse tanggal, validasi format YYYY-MM-DD
            $parsed = \DateTime::createFromFormat('Y-m-d', $endDate);
            if (!$parsed) {
                $this->view('events.create', [
                    'title' => 'Create Event',
                    'error' => 'Format tanggal akhir tidak valid. Gunakan format YYYY-MM-DD (contoh: 2026-02-11).'
                ]);
                return;
            }
            $endDate = $parsed->format('Y-m-d');
        }

        if ($capacity === '') {
            $capacity = null;
        } else {
            // Validasi capacity adalah angka positif
            $capacity = (int) $capacity;
            if ($capacity <= 0) {
                $this->view('events.create', [
                    'title' => 'Create Event',
                    'error' => 'Kapasitas harus berupa angka positif.'
                ]);
                return;
            }
        }

        if ($title === '' || $description === '') {
            $this->view('events.create', [
                'title' => 'Create Event',
                'error' => 'Title dan deskripsi wajib diisi.'
            ]);
            return;
        }

        $bannerPath = $this->handleUpload('gambar');

        $eventModel = new Event();
        $eventModel->create([
            'title' => $title,
            'description' => $description,
            'banner_path' => $bannerPath,
            'created_by' => $_SESSION['user']['id'],
            'location' => $location,
            'start_date' => $startDate,
            'end_date' => $endDate,
            'capacity' => $capacity
        ]);

        $this->redirect('/events');
    }

    public function show(int $id)
    {
        $this->requireAuth();

        $eventModel = new Event();
        $event = $eventModel->findById($id);

        if (!$event) {
            http_response_code(404);
            echo '<h1>Event not found</h1>';
            return;
        }

        $registrationModel = new Registration();
        $userId = (int) ($_SESSION['user']['id'] ?? 0);
        $isRegistered = $userId > 0 ? $registrationModel->exists($id, $userId) : false;

        // Get capacity info
        $capacityInfo = $eventModel->getCapacityInfo($id);
        $participants = [];
        if ($this->isAdmin()) {
            $participants = $registrationModel->listByEvent($id);
        }

        $this->view('events.show', [
            'title' => $event['title'],
            'event' => $event,
            'isAdmin' => $this->isAdmin(),
            'isRegistered' => $isRegistered,
            'capacityInfo' => $capacityInfo,
            'participants' => $participants,
            'flashSuccess' => $this->getFlash('success'),
            'flashError' => $this->getFlash('error')
        ]);
    }

    public function edit(int $id)
    {
        $this->requireRole('admin');

        $eventModel = new Event();
        $event = $eventModel->findById($id);

        if (!$event) {
            http_response_code(404);
            echo '<h1>Event not found</h1>';
            return;
        }

        $this->view('events.edit', [
            'title' => 'Edit Event',
            'event' => $event
        ], 'layouts.no-sidebar');
    }

    public function update(int $id)
    {
        $this->requireRole('admin');

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/events');
        }

        $eventModel = new Event();
        $event = $eventModel->findById($id);

        if (!$event) {
            http_response_code(404);
            echo '<h1>Event not found</h1>';
            return;
        }

        $title = trim($_POST['title'] ?? '');
        $description = trim($_POST['content'] ?? '');
        $location = trim($_POST['location'] ?? '');
        $startDate = $_POST['start_date'] ?? null;
        $endDate = $_POST['end_date'] ?? null;
        $capacity = $_POST['capacity'] ?? null;

        if ($startDate === '') {
            $startDate = null;
        }
        if ($endDate === '') {
            $endDate = null;
        }
        if ($capacity === '') {
            $capacity = null;
        }

        if ($title === '' || $description === '') {
            $this->view('events.edit', [
                'title' => 'Edit Event',
                'event' => $event,
                'error' => 'Title dan deskripsi wajib diisi.'
            ]);
            return;
        }

        $bannerPath = $this->handleUpload('image', $event['banner_path']);

        $eventModel->update($id, [
            'title' => $title,
            'description' => $description,
            'banner_path' => $bannerPath,
            'location' => $location,
            'start_date' => $startDate,
            'end_date' => $endDate,
            'capacity' => $capacity
        ]);

        $this->redirect('/events/' . $id);
    }

    public function destroy(int $id)
    {
        $this->requireRole('admin');

        $eventModel = new Event();
        $event = $eventModel->findById($id);

        if (!$event) {
            http_response_code(404);
            echo '<h1>Event not found</h1>';
            return;
        }

        if (!empty($event['banner_path'])) {
            $this->removeFile($event['banner_path']);
        }

        $eventModel->delete($id);
        $this->redirect('/events');
    }

    public function register(int $id)
    {
        $this->requireRole('participant');

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/events/' . $id);
        }

        $eventModel = new Event();
        $event = $eventModel->findById($id);

        if (!$event) {
            http_response_code(404);
            echo '<h1>Event not found</h1>';
            return;
        }

        $registrationModel = new Registration();
        $userId = (int) $_SESSION['user']['id'];

        if ($registrationModel->exists($id, $userId)) {
            $this->setFlash('error', 'Anda sudah terdaftar di event ini.');
            $this->redirect('/events/' . $id);
        }

        if (!empty($event['capacity'])) {
            $currentCount = $registrationModel->countByEvent($id);
            if ($currentCount >= (int) $event['capacity']) {
                $this->setFlash('error', 'Kuota event sudah penuh.');
                $this->redirect('/events/' . $id);
            }
        }

        if ($registrationModel->register($id, $userId)) {
            $this->setFlash('success', 'Registrasi berhasil. Sampai jumpa di event!');
            $this->redirect('/events/' . $id);
        }

        $this->setFlash('error', 'Registrasi gagal. Silakan coba lagi.');
        $this->redirect('/events/' . $id);
    }

    public function updateParticipantStatus(int $eventId, int $registrationId)
    {
        $this->requireRole('admin');

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/events/' . $eventId);
        }

        $status = trim($_POST['status'] ?? '');
        $validStatuses = ['registered', 'cancelled', 'attended'];

        if (!in_array($status, $validStatuses)) {
            $this->setFlash('error', 'Status tidak valid.');
            $this->redirect('/events/' . $eventId);
            return;
        }

        $registrationModel = new Registration();
        if ($registrationModel->updateStatus($registrationId, $status)) {
            $this->setFlash('success', 'Status peserta berhasil diupdate.');
        } else {
            $this->setFlash('error', 'Gagal mengupdate status peserta.');
        }

        $this->redirect('/events/' . $eventId);
    }

    public function updateEventStatus(int $id)
    {
        $this->requireRole('admin');

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/events/' . $id);
        }

        $status = trim($_POST['status'] ?? '');
        $validStatuses = ['draft', 'ongoing', 'completed', 'cancelled'];

        if (!in_array($status, $validStatuses)) {
            $this->setFlash('error', 'Status event tidak valid.');
            $this->redirect('/events/' . $id);
            return;
        }

        $eventModel = new Event();
        if ($eventModel->updateStatus($id, $status)) {
            $this->setFlash('success', 'Status event berhasil diupdate menjadi ' . ucfirst($status) . '.');
        } else {
            $this->setFlash('error', 'Gagal mengupdate status event.');
        }

        $this->redirect('/events/' . $id);
    }

    private function handleUpload(string $field, ?string $currentPath = null): ?string
    {
        if (!isset($_FILES[$field]) || $_FILES[$field]['error'] !== UPLOAD_ERR_OK) {
            return $currentPath;
        }

        $uploadDir = __DIR__ . '/../../public/uploads/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        $fileName = $_FILES[$field]['name'];
        $extension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        $safeName = md5(uniqid('', true) . $fileName) . '.' . $extension;
        $destination = $uploadDir . $safeName;

        if (move_uploaded_file($_FILES[$field]['tmp_name'], $destination)) {
            if ($currentPath) {
                $this->removeFile($currentPath);
            }
            return 'uploads/' . $safeName;
        }

        return $currentPath;
    }

    private function removeFile(string $path)
    {
        $fullPath = __DIR__ . '/../../public/' . ltrim($path, '/');
        if (file_exists($fullPath)) {
            unlink($fullPath);
        }
    }
}
