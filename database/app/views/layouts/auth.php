<?php
$pageTitle = $title ?? 'Sentra';
$bodyClass = $bodyClass ?? 'bg-[#e6fbf7] min-h-screen flex items-center justify-center font-sans p-4';
$headContent = $headContent ?? '';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title><?= htmlspecialchars($pageTitle); ?></title>
    <?= $headContent; ?>
    <style>
        :root {
            --sentra-green: #5bb7a7;
            --sentra-green-dark: #3f8e82;
            --sentra-ink: #1f2a29;
            --sentra-muted: #6c7a78;
            --sentra-border: #dff0ed;
        }

        .auth-card {
            border-radius: 32px;
            box-shadow: 0 24px 60px rgba(25, 59, 54, 0.18);
        }

        .auth-input {
            border-radius: 999px;
            border: 2px solid rgba(91, 183, 167, 0.45);
            transition: border 200ms ease, box-shadow 200ms ease;
        }

        .auth-input:focus {
            border-color: rgba(91, 183, 167, 0.9);
            box-shadow: 0 0 0 3px rgba(91, 183, 167, 0.2);
        }

        .auth-button {
            border-radius: 999px;
            background: linear-gradient(135deg, #69cbbf, #4fae9e);
            box-shadow: 0 12px 24px rgba(79, 174, 158, 0.4);
        }
    </style>
</head>

<body class="<?= htmlspecialchars($bodyClass); ?>">
    <?php include $contentView; ?>
</body>

</html>