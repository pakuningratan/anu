# Panduan Instalasi NFS Server pada CentOS 7
NFS (Network File System) adalah protokol yang digunakan untuk berbagi sistem file melalui jaringan. NFS memungkinkan pengguna di satu mesin untuk mengakses file yang disimpan di mesin lain dalam jaringan dengan cara yang mirip dengan mengakses file lokal. Dalam panduan ini, kita akan membahas langkah-langkah detil untuk menginstal dan mengkonfigurasi NFS Server pada CentOS 7.
## Persyaratan Sistem
Sebelum memulai instalasi NFS Server, pastikan Anda telah memenuhi persyaratan sistem berikut:
1. Mesin yang menjalankan CentOS 7.
2. Hak akses root atau hak akses sudo.
## Langkah 1: Memperbarui Sistem
Sebelum menginstal NFS Server, langkah pertama yang perlu dilakukan adalah memperbarui sistem operasi Anda ke versi terbaru. Anda dapat melakukannya dengan menjalankan perintah berikut di terminal:
```
sudo yum update
```
Setelah perintah selesai dieksekusi, sistem operasi Anda akan diperbarui dengan paket-paket terbaru.
## Langkah 2: Menginstal NFS Server
Setelah sistem diperbarui, langkah selanjutnya adalah menginstal paket NFS Server. Untuk melakukan ini, jalankan perintah berikut di terminal:
```
sudo yum install nfs-utils
```
Perintah ini akan menginstal paket nfs-utils yang diperlukan untuk menjalankan NFS Server.
## Langkah 3: Menyiapkan Direktori Berbagi
Setelah menginstal paket NFS Server, langkah berikutnya adalah menyiapkan direktori yang akan dibagikan melalui NFS. Anda dapat memilih direktori apa pun di sistem Anda untuk digunakan sebagai direktori berbagi. Misalnya, dalam panduan ini, kita akan menggunakan direktori `/data` sebagai direktori berbagi.
1. Buat direktori `/data` dengan menjalankan perintah berikut:
```
sudo mkdir /data
```
2. Setelah direktori dibuat, ubah kepemilikan direktori menjadi `nfsnobody` dengan menjalankan perintah berikut:
```
sudo chown nfsnobody:nfsnobody /data
```
3. Berikan izin baca dan tulis kepada `nfsnobody` dengan menjalankan perintah berikut:
```
sudo chmod 755 /data
```
## Langkah 4: Mengkonfigurasi NFS Server
Setelah direktori berbagi telah disiapkan, langkah selanjutnya adalah mengkonfigurasi NFS Server untuk mengizinkan akses ke direktori tersebut.
1. Buka file konfigurasi NFS Server dengan menggunakan editor teks seperti nano atau vim:
```
sudo nano /etc/exports
```
2. Di dalam file ini, tambahkan baris berikut:
```
/data  *(rw,sync,no_root_squash,no_all_squash)
```
Baris ini mengizinkan semua host di jaringan untuk mengakses direktori `/data` dengan izin baca dan tulis (rw). Opsi `sync` mengharuskan setiap perubahan pada server disinkronkan dengan klien sebelum aksi berikutnya dilakukan. Opsi `no_root_squash` memungkinkan pengguna root di klien untuk memiliki hak akses root di server. Opsi `no_all_squash` memungkinkan semua pengguna di klien untuk memiliki hak akses yang sama di server.
3. Setelah menambahkan baris tersebut, simpan dan keluar dari editor teks.
4. Untuk menerapkan perubahan pada konfigurasi NFS Server, jalankan perintah berikut di terminal:
```
sudo exportfs -a
```
## Langkah 5: Menjalankan dan Mengaktifkan NFS Server
Setelah konfigurasi NFS Server selesai, langkah terakhir adalah menjalankan dan mengaktifkan NFS Server.
1. Jalankan perintah berikut di terminal untuk memulai layanan NFS:
```
sudo systemctl start nfs-server
```
2. Untuk memastikan bahwa layanan NFS Server berjalan setiap kali sistem di-boot, aktifkan layanan NFS Server dengan menjalankan perintah berikut:
```
sudo systemctl enable nfs-server
```
3. Terakhir, pastikan layanan NFS Server berjalan dengan menjalankan perintah berikut:
```
sudo systemctl status nfs-server
```
Jika Anda melihat pesan yang mengindikasikan bahwa layanan berjalan dengan baik, itu berarti NFS Server telah berhasil diinstal dan dikonfigurasi.
## Mengakses Direktori Berbagi dari Klien
Setelah NFS Server diinstal dan dikonfigurasi, Anda dapat mengakses direktori berbagi dari klien dalam jaringan yang sama.
1. Pastikan klien Anda juga menjalankan CentOS 7 atau distribusi Linux lain yang mendukung NFS.
2. Buka terminal pada klien dan jalankan perintah berikut untuk menginstal paket NFS:
```
sudo yum install nfs-utils
```
3. Setelah paket nfs-utils diinstal, buat direktori di klien yang akan digunakan untuk mengakses direktori berbagi. Misalnya, jalankan perintah berikut untuk membuat direktori `/mnt/nfs`:
```
sudo mkdir /mnt/nfs
```
4. Selanjutnya, jalankan perintah berikut untuk melakukan mounting direktori berbagi dari server ke direktori di klien:
```
sudo mount <alamat IP NFS Server>:/data /mnt/nfs
```
Gantilah `<alamat IP NFS Server>` dengan alamat IP yang sesuai dari NFS Server Anda.
5. Setelah mounting berhasil, Anda dapat mengakses dan menggunakan file yang ada di direktori berbagi melalui direktori `/mnt/nfs` pada klien.
## Kesimpulan
Dalam panduan ini, kita telah membahas langkah-langkah detil untuk menginstal dan mengkonfigurasi NFS Server pada CentOS 7. Dengan mengikuti langkah-langkah ini, Anda dapat dengan mudah mengaktifkan berbagi file melalui jaringan menggunakan protokol NFS. Ingatlah untuk mengamankan akses NFS Server dengan mengatur izin dan firewall yang sesuai. Selamat mencoba!
