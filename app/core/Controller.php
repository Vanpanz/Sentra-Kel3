<?php
namespace App\Core;

class Controller
{

    protected function view(string $view, array $data = [], string $layout = 'layouts.app')
    {
        $this->ensureSession();

        $viewPath = '../app/views/' . str_replace('.', '/', $view) . '.php';
        $layoutPath = '../app/views/' . str_replace('.', '/', $layout) . '.php';

        if (!file_exists($viewPath)) {
            http_response_code(500);
            echo 'View not found: ' . htmlspecialchars($view);
            return;
        }

        if (!file_exists($layoutPath)) {
            http_response_code(500);
            echo 'Layout not found: ' . htmlspecialchars($layout);
            return;
        }

        extract($data, EXTR_SKIP);

        $contentView = $viewPath;
        include $layoutPath;
    }

    protected function redirect(string $path)
    {
        header('Location: ' . $path);
        exit;
    }

    protected function ensureSession()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    protected function requireAuth()
    {
        $this->ensureSession();

        if (empty($_SESSION['user'])) {
            $this->redirect('/login');
        }
    }

    protected function requireRole(string $role)
    {
        $this->requireAuth();

        if (($_SESSION['user']['role'] ?? '') !== $role) {
            $this->redirect('/events');
        }
    }

    protected function currentUser(): ?array
    {
        $this->ensureSession();
        return $_SESSION['user'] ?? null;
    }

    protected function isAdmin(): bool
    {
        return ($this->currentUser()['role'] ?? '') === 'admin';
    }

    protected function setFlash(string $key, string $message)
    {
        $this->ensureSession();
        if (!isset($_SESSION['flash'])) {
            $_SESSION['flash'] = [];
        }
        $_SESSION['flash'][$key] = $message;
    }

    protected function getFlash(string $key): ?string
    {
        $this->ensureSession();
        if (!isset($_SESSION['flash'][$key])) {
            return null;
        }

        $message = $_SESSION['flash'][$key];
        unset($_SESSION['flash'][$key]);
        return $message;
    }

}

?>