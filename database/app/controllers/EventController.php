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
        ]);
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

        $this->view('events.show', [
            'title' => $event['title'],
            'event' => $event,
            'isAdmin' => $this->isAdmin(),
            'isRegistered' => $isRegistered,
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
        ]);
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
