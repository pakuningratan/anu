<?php
/** @var string $content */
/** @var string|null $title */
/** @var array $errors */
/** @var array $old */
/** @var array|null $flash */
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($title ?? 'Platform Diskusi ASN') ?></title>
    <link rel="stylesheet" href="/assets/css/app.css">
</head>
<body>
<header class="app-header">
    <div class="container">
        <div class="header-content">
            <a class="brand" href="/">Diskusi ASN Trenggalek</a>
            <nav class="nav">
                <a href="/diskusi" class="nav-link">Forum Diskusi</a>
                <a href="/diskusi/create" class="nav-link nav-link--primary">Buat Diskusi</a>
            </nav>
        </div>
    </div>
</header>
<main class="container">
    <?php if (!empty($flash) && is_array($flash)): ?>
        <div class="alert alert--<?= e($flash['type'] ?? 'info') ?>">
            <?= e($flash['message'] ?? '') ?>
        </div>
    <?php endif; ?>
    <?= $content ?>
</main>
<footer class="app-footer">
    <div class="container">
        <p>© <?= date('Y') ?> Pemerintah Kabupaten Trenggalek · Platform Diskusi ASN</p>
    </div>
</footer>
</body>
</html>
