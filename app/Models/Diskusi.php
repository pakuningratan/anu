<?php

declare(strict_types=1);

namespace App\Models;

use App\Database\Connection;
use PDO;

class Diskusi
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Connection::make();
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    public function all(): array
    {
        $statement = $this->db->query('SELECT * FROM diskusi ORDER BY created_at DESC');

        return $statement ? $statement->fetchAll() : [];
    }

    public function find(int $id): ?array
    {
        $statement = $this->db->prepare('SELECT * FROM diskusi WHERE id = :id LIMIT 1');
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->execute();
        $result = $statement->fetch();

        return $result === false ? null : $result;
    }

    /**
     * @param array<string, string> $data
     */
    public function create(array $data): int
    {
        $now = date('Y-m-d H:i:s');
        $statement = $this->db->prepare('INSERT INTO diskusi (judul, penulis, isi, created_at, updated_at) VALUES (:judul, :penulis, :isi, :created_at, :updated_at)');
        $statement->execute([
            ':judul' => $data['judul'],
            ':penulis' => $data['penulis'],
            ':isi' => $data['isi'],
            ':created_at' => $now,
            ':updated_at' => $now,
        ]);

        return (int) $this->db->lastInsertId();
    }

    /**
     * @param array<string, string> $data
     */
    public function update(int $id, array $data): bool
    {
        $statement = $this->db->prepare('UPDATE diskusi SET judul = :judul, penulis = :penulis, isi = :isi, updated_at = :updated_at WHERE id = :id');

        return $statement->execute([
            ':judul' => $data['judul'],
            ':penulis' => $data['penulis'],
            ':isi' => $data['isi'],
            ':updated_at' => date('Y-m-d H:i:s'),
            ':id' => $id,
        ]);
    }

    public function delete(int $id): bool
    {
        $statement = $this->db->prepare('DELETE FROM diskusi WHERE id = :id');

        return $statement->execute([':id' => $id]);
    }
}
