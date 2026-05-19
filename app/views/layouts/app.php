<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $page_title ?? 'SENTRA - Event Management System' ?></title>
    <link rel="stylesheet" href="/css/output.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html, body {
            height: 100%;
        }

        body {
            display: flex;
            flex-direction: column;
            background-color: #f3f4f6;
        }

        main {
            flex: 1;
        }

        /* Alert Styles */
        .alert {
            padding: 1rem;
            border-radius: 0.5rem;
            margin-bottom: 1rem;
        }

        .alert-success {
            background-color: #d1fae5;
            color: #065f46;
            border-left: 4px solid #10b981;
        }

        .alert-error {
            background-color: #fee2e2;
            color: #991b1b;
            border-left: 4px solid #ef4444;
        }

        .alert-warning {
            background-color: #fef3c7;
            color: #92400e;
            border-left: 4px solid #f59e0b;
        }

        .alert-info {
            background-color: #dbeafe;
            color: #1e40af;
            border-left: 4px solid #3b82f6;
        }

        /* Loading Animation */
        .spinner {
            border: 4px solid #f3f4f6;
            border-top: 4px solid #3b82f6;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            animation: spin 1s linear infinite;
            margin: 2rem auto;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Card Styles */
        .card {
            background: white;
            border-radius: 0.5rem;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            padding: 1.5rem;
        }

        .card-header {
            font-size: 1.25rem;
            font-weight: bold;
            margin-bottom: 1rem;
            color: #1f2937;
        }

        /* Button Styles */
        .btn {
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            border: none;
            cursor: pointer;
            font-size: 0.875rem;
            font-weight: 500;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .btn-primary {
            background-color: #3b82f6;
            color: white;
        }

        .btn-primary:hover {
            background-color: #2563eb;
        }

        .btn-secondary {
            background-color: #6b7280;
            color: white;
        }

        .btn-secondary:hover {
            background-color: #4b5563;
        }

        .btn-success {
            background-color: #10b981;
            color: white;
        }

        .btn-success:hover {
            background-color: #059669;
        }

        .btn-danger {
            background-color: #ef4444;
            color: white;
        }

        .btn-danger:hover {
            background-color: #dc2626;
        }

        /* Form Styles */
        .form-group {
            margin-bottom: 1rem;
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            color: #374151;
            font-weight: 500;
        }

        .form-control {
            width: 100%;
            padding: 0.5rem 0.75rem;
            border: 1px solid #d1d5db;
            border-radius: 0.375rem;
            font-size: 0.875rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59,130,246,0.1);
        }

        /* Table Styles */
        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table thead {
            background-color: #f3f4f6;
        }

        .table th, .table td {
            padding: 0.75rem;
            text-align: left;
            border-bottom: 1px solid #e5e7eb;
        }

        .table tr:hover {
            background-color: #f9fafb;
        }
    </style>
</head>

<body>
    <!-- Header Start -->
    <?php require_once '../app/views/layouts/partials/header.php'; ?>
    <!-- Header End -->

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-8">
        <!-- Flash Messages -->
        <?php if (isset($success)): ?>
            <div class="alert alert-success">
                <strong>✓ Sukses!</strong> <?= htmlspecialchars($success) ?>
            </div>
        <?php endif; ?>

        <?php if (isset($error)): ?>
            <div class="alert alert-error">
                <strong>✗ Error!</strong> <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <?php if (isset($warning)): ?>
            <div class="alert alert-warning">
                <strong>⚠ Perhatian!</strong> <?= htmlspecialchars($warning) ?>
            </div>
        <?php endif; ?>

        <?php if (isset($info)): ?>
            <div class="alert alert-info">
                <strong>ℹ Info</strong> <?= htmlspecialchars($info) ?>
            </div>
        <?php endif; ?>

        <!-- Page Content -->
        <?php require_once $content; ?>
    </main>
    <!-- Main Content End -->

    <!-- Footer Start -->
    <?php require_once '../app/views/layouts/partials/footer.php'; ?>
    <!-- Footer End -->
</body>

</html>
