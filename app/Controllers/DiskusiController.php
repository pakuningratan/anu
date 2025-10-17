<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\Diskusi;

class DiskusiController
{
    private Diskusi $diskusi;

    public function __construct()
    {
        $this->diskusi = new Diskusi();
    }

    public function index(): void
    {
        $items = $this->diskusi->all();

        view('diskusi/index', [
            'title' => 'Daftar Diskusi ASN',
            'items' => $items,
        ]);
    }

    public function show(int $id): void
    {
        $diskusi = $this->diskusi->find($id);

        if (!$diskusi) {
            $_SESSION['flash'] = [
                'type' => 'error',
                'message' => 'Diskusi tidak ditemukan.',
            ];
            redirect('/diskusi');
        }

        view('diskusi/show', [
            'title' => $diskusi['judul'] . ' - Detail Diskusi',
            'diskusi' => $diskusi,
        ]);
    }

    public function create(): void
    {
        view('diskusi/create', [
            'title' => 'Buat Diskusi Baru',
        ]);
    }

    public function store(): void
    {
        $data = $this->getInput();
        $errors = $this->validate($data);

        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            $_SESSION['old'] = $data;
            redirect('/diskusi/create');
        }

        $this->diskusi->create($data);

        $_SESSION['flash'] = [
            'type' => 'success',
            'message' => 'Diskusi berhasil dibuat.',
        ];

        redirect('/diskusi');
    }

    public function edit(int $id): void
    {
        $diskusi = $this->diskusi->find($id);

        if (!$diskusi) {
            $_SESSION['flash'] = [
                'type' => 'error',
                'message' => 'Diskusi tidak ditemukan.',
            ];
            redirect('/diskusi');
        }

        view('diskusi/edit', [
            'title' => 'Ubah Diskusi',
            'diskusi' => $diskusi,
        ]);
    }

    public function update(int $id): void
    {
        $diskusi = $this->diskusi->find($id);

        if (!$diskusi) {
            $_SESSION['flash'] = [
                'type' => 'error',
                'message' => 'Diskusi tidak ditemukan.',
            ];
            redirect('/diskusi');
        }

        $data = $this->getInput();
        $errors = $this->validate($data);

        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            $_SESSION['old'] = $data;
            redirect("/diskusi/{$id}/edit");
        }

        $this->diskusi->update($id, $data);

        $_SESSION['flash'] = [
            'type' => 'success',
            'message' => 'Diskusi berhasil diperbarui.',
        ];

        redirect('/diskusi');
    }

    public function destroy(int $id): void
    {
        $diskusi = $this->diskusi->find($id);

        if (!$diskusi) {
            $_SESSION['flash'] = [
                'type' => 'error',
                'message' => 'Diskusi tidak ditemukan.',
            ];
            redirect('/diskusi');
        }

        $this->diskusi->delete($id);

        $_SESSION['flash'] = [
            'type' => 'success',
            'message' => 'Diskusi berhasil dihapus.',
        ];

        redirect('/diskusi');
    }

    /**
     * @return array<string, string>
     */
    private function getInput(): array
    {
        $judul = trim($_POST['judul'] ?? '');
        $penulis = trim($_POST['penulis'] ?? '');
        $isi = trim($_POST['isi'] ?? '');

        return [
            'judul' => $judul,
            'penulis' => $penulis,
            'isi' => $isi,
        ];
    }

    /**
     * @param array<string, string> $data
     * @return array<string, string>
     */
    private function validate(array $data): array
    {
        $errors = [];

        if ($data['judul'] === '') {
            $errors['judul'] = 'Judul wajib diisi.';
        }

        if ($data['penulis'] === '') {
            $errors['penulis'] = 'Penulis wajib diisi.';
        }

        if ($data['isi'] === '') {
            $errors['isi'] = 'Isi diskusi wajib diisi.';
        }

        return $errors;
    }
}
