<?php

declare(strict_types=1);

function view(string $path, array $data = []): void
{
    $baseViewPath = __DIR__ . '/Views/';
    $viewFile = $baseViewPath . $path . '.php';

    if (!file_exists($viewFile)) {
        throw new \RuntimeException("View {$path} tidak ditemukan");
    }

    $shared = [
        'errors' => $_SESSION['errors'] ?? [],
        'old' => $_SESSION['old'] ?? [],
        'flash' => $_SESSION['flash'] ?? null,
    ];

    unset($_SESSION['errors'], $_SESSION['old'], $_SESSION['flash']);

    extract(array_merge($shared, $data));

    ob_start();
    require $viewFile;
    $content = ob_get_clean();

    require $baseViewPath . 'layouts/main.php';
}

function redirect(string $path): void
{
    header('Location: ' . $path);
    exit;
}

function e(?string $value): string
{
    return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
}

function format_datetime(?string $value): string
{
    if (!$value) {
        return '-';
    }

    $timestamp = strtotime($value);

    return $timestamp ? date('d M Y \p\u\k\u\l H:i', $timestamp) : $value;
}
