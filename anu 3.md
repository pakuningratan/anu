# Panduan Instalasi FTP Server pada CentOS 7 dan Cara Mencoba FTP

FTP (File Transfer Protocol) adalah protokol yang digunakan untuk mentransfer file antara komputer lokal dan server. FTP Server adalah perangkat lunak atau layanan yang berjalan pada server untuk mengizinkan pengguna untuk mengakses dan mentransfer file secara aman melalui jaringan menggunakan protokol FTP.

Pada panduan ini, kita akan membahas langkah-langkah instalasi FTP Server pada CentOS 7 dan cara mencoba FTP untuk mentransfer file antara komputer lokal dan server menggunakan klien FTP.

## Persiapan Awal

Sebelum memulai instalasi FTP Server, pastikan Anda memiliki akses root atau memiliki hak administratif yang diperlukan untuk menginstal perangkat lunak dan mengkonfigurasi server.

## Langkah 1: Update Sistem

Langkah pertama yang perlu dilakukan adalah memperbarui sistem CentOS 7 Anda. Jalankan perintah berikut di terminal:

```
sudo yum update
```

Perintah ini akan memperbarui semua paket yang terinstal pada sistem Anda ke versi terbaru.

## Langkah 2: Instalasi vsftpd

Vsftpd (Very Secure FTP Daemon) adalah perangkat lunak FTP Server yang populer dan aman. Untuk menginstal vsftpd, jalankan perintah berikut:

```
sudo yum install vsftpd
```

Setelah instalasi selesai, Anda dapat memulai dan mengaktifkan layanan vsftpd dengan menjalankan perintah berikut:

```
sudo systemctl start vsftpd
sudo systemctl enable vsftpd
```

Perintah ini akan memulai layanan vsftpd dan mengatur agar layanan tersebut secara otomatis dimulai saat sistem boot.

## Langkah 3: Konfigurasi Firewall

Jika Anda menggunakan firewall pada sistem CentOS 7 Anda, Anda perlu mengizinkan lalu lintas FTP melalui firewall. Jalankan perintah berikut untuk mengizinkan lalu lintas FTP:

```
sudo firewall-cmd --permanent --add-port=21/tcp
sudo firewall-cmd --permanent --add-service=ftp
sudo firewall-cmd --reload
```

Perintah di atas akan mengizinkan lalu lintas FTP melalui port 21 dan mengaktifkan layanan FTP pada firewall.

## Langkah 4: Konfigurasi vsftpd

Konfigurasi vsftpd dapat dilakukan melalui file `/etc/vsftpd/vsftpd.conf`. Anda dapat menggunakan editor teks pilihan Anda untuk mengedit file ini. Misalnya, Anda dapat menggunakan nano dengan menjalankan perintah berikut:

```
sudo nano /etc/vsftpd/vsftpd.conf
```

Beberapa pengaturan yang mungkin perlu Anda ubah atau perhatikan adalah:

### a. Mengaktifkan Write Enable

Jika Anda ingin mengizinkan pengguna untuk mengunggah file ke server melalui FTP, pastikan baris berikut tidak diubah atau dikonfigurasi sebagai berikut:

```
write_enable=YES
```

### b. Mengatur Chroot Jail

Chroot jail adalah fitur keamanan yang membatasi akses pengguna FTP hanya pada direktori tertentu. Anda dapat mengatur direktori chroot jail dengan mengedit baris berikut:

```
chroot_local_user=YES
chroot_list_enable=YES
chroot_list_file=/etc/vsftpd/chroot_list
```

Anda juga perlu membuat file `/etc/vsftpd/chroot_list` dan menambahkan nama pengguna yang diizinkan untuk keluar dari chroot jail. Misalnya, jika Anda ingin mengizinkan pengguna 'john' untuk keluar dari chroot jail, tambahkan baris berikut ke file `/etc/vsftpd/chroot_list`:

```
john
```

### c. Mengatur User FTP

Anda dapat menambahkan pengguna FTP baru dengan menjalankan perintah berikut:

```
sudo useradd -m -s /sbin/nologin ftpuser
```

Perintah di atas akan membuat pengguna baru bernama 'ftpuser' dengan direktori rumah yang sesuai.

Setelah menambahkan pengguna baru, Anda perlu mengatur kata sandi untuk pengguna dengan menjalankan perintah berikut:

```
sudo passwd ftpuser
```

### d. Mengatur Hak Akses Direktori

Anda perlu memastikan bahwa pengguna FTP memiliki hak akses yang tepat pada direktori yang ingin mereka akses. Misalnya, jika Anda ingin mengizinkan pengguna FTP untuk mengakses direktori `/var/www/html`, jalankan perintah berikut:

```
sudo chown -R ftpuser:ftpuser /var/www/html
sudo chmod -R 755 /var/www/html
```

Perintah di atas akan mengubah kepemilikan direktori menjadi pengguna 'ftpuser' dan mengatur hak akses yang tepat pada direktori tersebut.

## Langkah 5: Restart vsftpd

Setelah Anda selesai mengkonfigurasi vsftpd, restart layanan untuk menerapkan perubahan yang telah Anda buat. Jalankan perintah berikut untuk merestart vsftpd:

```
sudo systemctl restart vsftpd
```

## Mencoba FTP

Sekarang, Anda dapat mencoba menggunakan klien FTP untuk mengakses server dan mentransfer file. Ada banyak klien FTP yang tersedia, tetapi dalam panduan ini, kami akan menggunakan klien FTP bawaan di sistem operasi Windows.

### a. Membuka Klien FTP

Pada komputer Windows Anda, buka File Explorer dan ketikkan `ftp://ip_address_server` di bilah alamat, di mana `ip_address_server` adalah alamat IP atau nama domain dari server FTP Anda. Tekan Enter untuk membuka koneksi FTP.

### b. Masuk ke Server FTP

Jika koneksi berhasil, Anda akan diminta untuk memasukkan nama pengguna dan kata sandi FTP. Masukkan nama pengguna dan kata sandi yang telah Anda buat sebelumnya.

Setelah masuk, Anda akan melihat struktur direktori server FTP. Anda dapat menavigasi melalui direktori dan mentransfer file antara komputer lokal dan server dengan mengklik dan menyeret file atau dengan menggunakan tombol kanan mouse dan memilih opsi "Upload" atau "Download".

## Kesimpulan

Dalam panduan ini, kami telah membahas langkah-langkah instalasi FTP Server pada CentOS 7 menggunakan vsftpd. Kami juga menjelaskan langkah-langkah konfigurasi yang penting dan cara mencoba FTP untuk mentransfer file antara komputer lokal dan server.

FTP server adalah alat yang sangat berguna untuk mentransfer file melalui jaringan. Namun, perlu diingat bahwa keamanan adalah faktor penting dalam pengaturan FTP server. Pastikan Anda mengatur pengaturan keamanan yang tepat dan membatasi akses pengguna hanya pada direktori yang diperlukan.

Saat menggunakan FTP, penting untuk menggunakan koneksi yang aman dan mengenkripsi data yang ditransfer. Jika keamanan adalah perhatian utama Anda, Anda dapat mempertimbangkan menggunakan protokol SFTP (Secure File Transfer Protocol) yang menggunakan enkripsi SSL/TLS untuk melindungi data Anda.

Semoga panduan ini bermanfaat dan membantu Anda menginstal dan mengkonfigurasi FTP Server pada CentOS 7. Selamat mencoba!
