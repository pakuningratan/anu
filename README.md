# Platform Diskusi ASN Trenggalek

Aplikasi forum diskusi berbasis PHP menggunakan pola MVC sederhana yang terinspirasi dari Leaf PHP. Aplikasi ini menyediakan CRUD penuh untuk entitas **Diskusi** yang dapat dimanfaatkan sebagai ruang berbagi ide, koordinasi lintas OPD, serta dokumentasi tindak lanjut kolaborasi antar Aparatur Sipil Negara (ASN) di Kabupaten Trenggalek.

## Fitur Utama

- Dashboard daftar diskusi dengan informasi penulis, tanggal pembuatan, serta aksi cepat.
- Form pembuatan, pengubahan, dan penghapusan diskusi.
- Halaman detail diskusi dengan konten lengkap.
- Validasi sisi server untuk memastikan seluruh kolom penting terisi.
- Penyimpanan data menggunakan SQLite sehingga aplikasi siap dijalankan secara mandiri.

## Struktur Direktori

```
.
├── app
│   ├── Controllers      # Logika pengendali aplikasi
│   ├── Database         # Koneksi dan inisialisasi basis data
│   ├── Models           # Abstraksi data diskusi
│   ├── Views            # Templat antarmuka pengguna
│   └── helpers.php      # Fungsi utilitas global
├── bootstrap            # Inisialisasi aplikasi dan rute
├── public               # Akar dokumen web server
│   ├── assets/css       # Berkas gaya antarmuka
│   └── index.php        # Titik masuk aplikasi
├── storage              # Lokasi penyimpanan database SQLite
└── leaf                 # Router ringan ala Leaf PHP
```

## Menjalankan Aplikasi

1. Pastikan ekstensi PHP dan SQLite sudah tersedia di lingkungan Anda.
2. Arahkan root dokumen web server (Apache/Nginx) ke direktori `public/`.
3. Atau jalankan server pengembangan bawaan PHP dari direktori proyek:

   ```bash
   php -S localhost:8000 -t public
   ```

4. Buka `http://localhost:8000` pada peramban pilihan Anda.

Aplikasi secara otomatis membuat berkas `storage/database.sqlite` beserta tabel `diskusi` pada saat pertama kali dijalankan.

## Catatan

- Direktori `storage/` telah dilengkapi aturan `.gitignore` sehingga file database tidak ikut terlacak.
- Seluruh tampilan menggunakan gaya responsif agar nyaman diakses melalui perangkat seluler.
- Untuk menyesuaikan atau memperluas fungsionalitas, tambahkan controller, model, dan rute baru sesuai kebutuhan.
