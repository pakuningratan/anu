# Platform Diskusi ASN Trenggalek

Aplikasi web statis untuk memfasilitasi kolaborasi dan diskusi antar Aparatur Sipil Negara (ASN) di Kabupaten Trenggalek. Aplikasi ini menyediakan ruang berbagi ide, koordinasi lintas OPD, papan pengumuman resmi, serta daftar agenda kegiatan terkini.

## Fitur Utama

- **Dashboard ringkas** berisi statistik partisipasi, topik trending, dan unit kerja teraktif.
- **Forum diskusi dinamis** dengan pencarian, filter kategori, dan pembuatan topik baru yang tersimpan di _local storage_.
- **Agenda ASN** untuk memantau pertemuan dan lokakarya penting.
- **Pengumuman kebijakan** serta tautan menuju sumber daya pendukung kolaborasi.
- **Panduan partisipasi** dalam bentuk modal agar diskusi tetap produktif.

## Cara Menggunakan

1. Buka berkas `index.html` langsung melalui peramban modern (Chrome, Edge, Firefox, atau Safari).
2. Gunakan kolom pencarian dan dropdown kategori untuk menemukan topik diskusi.
3. Isi formulir "Buat Diskusi Baru" untuk menambah topik. Data akan tersimpan di perangkat melalui _local storage_.
4. Klik tombol "Lihat Panduan" untuk memahami etika dan alur diskusi.

## Struktur Proyek

```
webapp/
├── index.html    # Templat utama antarmuka
├── styles.css    # Gaya visual aplikasi
├── app.js        # Logika interaktif dan manajemen data local storage
└── README.md     # Dokumentasi aplikasi
```

## Pengembangan Lanjutan

- Integrasikan autentikasi ASN dan kanal resmi Pemerintah Kabupaten Trenggalek.
- Hubungkan forum dengan API atau basis data terpusat untuk kolaborasi lintas perangkat.
- Tambahkan fitur notifikasi dan pelacakan tindak lanjut diskusi penting.
