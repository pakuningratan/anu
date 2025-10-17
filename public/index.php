<?php

declare(strict_types=1);

session_start();

spl_autoload_register(function (string $class): void {
    $prefixes = [
        'App\\' => __DIR__ . '/../app/',
        'Leaf\\' => __DIR__ . '/../leaf/',
    ];

    foreach ($prefixes as $prefix => $baseDir) {
        $length = strlen($prefix);
        if (strncmp($class, $prefix, $length) !== 0) {
            continue;
        }

        $relativeClass = substr($class, $length);
        $file = $baseDir . str_replace('\\', '/', $relativeClass) . '.php';

        if (file_exists($file)) {
            require $file;
        }
    }
});

date_default_timezone_set('Asia/Jakarta');

require __DIR__ . '/../app/helpers.php';
require __DIR__ . '/../bootstrap/app.php';
