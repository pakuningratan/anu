<?php

declare(strict_types=1);

namespace App\Database;

use PDO;
use PDOException;

class Connection
{
    private static ?PDO $pdo = null;
    private static bool $migrated = false;

    public static function make(): PDO
    {
        if (static::$pdo instanceof PDO) {
            return static::$pdo;
        }

        $databasePath = __DIR__ . '/../../storage/database.sqlite';
        $directory = dirname($databasePath);

        if (!is_dir($directory)) {
            mkdir($directory, 0777, true);
        }

        $dsn = 'sqlite:' . $databasePath;

        try {
            static::$pdo = new PDO($dsn);
            static::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            static::$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            throw new PDOException('Tidak dapat terhubung ke basis data: ' . $exception->getMessage(), (int) $exception->getCode(), $exception);
        }

        static::migrate();

        return static::$pdo;
    }

    private static function migrate(): void
    {
        if (static::$migrated === true && static::$pdo instanceof PDO) {
            return;
        }

        $sql = <<<SQL
        CREATE TABLE IF NOT EXISTS diskusi (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            judul TEXT NOT NULL,
            penulis TEXT NOT NULL,
            isi TEXT NOT NULL,
            created_at TEXT NOT NULL,
            updated_at TEXT NOT NULL
        )
        SQL;

        static::$pdo?->exec($sql);
        static::$migrated = true;
    }
}
