<?php
$pageTitle = $title ?? 'Sentra';
$bodyClass = $bodyClass ?? 'font-[\'Plus_Jakarta_Sans\'] bg-[#E4FEF7] text-[#2d3436] antialiased';
$headContent = $headContent ?? '';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle); ?></title>
    <link rel="stylesheet" href="/css/output.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
    <?= $headContent; ?>
    <style>
        :root {
            --sentra-green: #5bb7a7;
            --sentra-green-dark: #3f8e82;
            --sentra-green-soft: #eaf6f3;
            --sentra-ink: #1f2a29;
            --sentra-muted: #63706e;
            --sentra-border: #e5f0ee;
            --sentra-card: #ffffff;
            --sentra-shadow: 0 12px 35px rgba(16, 42, 38, 0.08);
        }

        .app-shell {
            background: #E4FEF7;
        }

        .card {
            background: var(--sentra-card);
            border: 1px solid var(--sentra-border);
            border-radius: 24px;
            box-shadow: var(--sentra-shadow);
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--sentra-green), #6cc4b5);
            color: #fff;
            border-radius: 16px;
            font-weight: 700;
            transition: transform 200ms ease, box-shadow 200ms ease, opacity 200ms ease;
            box-shadow: 0 10px 24px rgba(91, 183, 167, 0.32);
        }

        .btn-primary:hover {
            transform: translateY(-1px);
            opacity: 0.95;
        }

        .btn-secondary {
            background: #fff;
            color: var(--sentra-muted);
            border: 1px solid var(--sentra-border);
            border-radius: 16px;
            font-weight: 700;
            transition: border 200ms ease, transform 200ms ease, box-shadow 200ms ease;
            box-shadow: 4px 4px 5px rgba(16, 42, 38, 0.08);
        }

        .btn-secondary:hover {
            border-color: rgba(91, 183, 167, 0.4);
            transform: translateY(-1px);
        }

        .input-field {
            border-radius: 16px;
            border: 1px solid var(--sentra-border);
            background: #fff;
            transition: border 200ms ease, box-shadow 200ms ease;
            box-shadow: 4px 4px 5px rgba(16, 42, 38, 0.08);
        }

        .input-field:focus {
            border-color: rgba(91, 183, 167, 0.6);
            box-shadow: 0 0 0 3px rgba(91, 183, 167, 0.18);
        }

        .badge-soft {
            background: rgba(91, 183, 167, 0.15);
            color: var(--sentra-green-dark);
            border-radius: 999px;
            font-weight: 700;
            letter-spacing: 0.06em;
        }
    </style>
</head>

<body class="<?= htmlspecialchars($bodyClass); ?>">

    <div class="app-shell min-h-screen">
        <main class="max-w-5xl mx-auto p-8 lg:px-12 overflow-y-auto">
            <?php include $contentView; ?>
        </main>
    </div>

    <?php include __DIR__ . '/partials/footer.php'; ?>
    <?php include __DIR__ . '/partials/modal.php'; ?>
</body>

</html>
