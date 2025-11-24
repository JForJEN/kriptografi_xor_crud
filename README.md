
# CRUD PHP + MySQL dengan Enkripsi XOR (Kriptografi Simetris)

Projek ini merupakan implementasi kriptografi simetris menggunakan metode Stream XOR pada aplikasi CRUD (Create, Read, Update, Delete) berbasis PHP dan MySQL.  
Setiap data yang disimpan ke dalam database akan dienkripsi terlebih dahulu, dan saat ditampilkan di-dekripsi secara otomatis.

Aplikasi ini dibuat untuk memenuhi tugas implementasi kriptografi dan steganografi (sesi 6).

📌 Fitur Aplikasi
🔐 Enkripsi & Dekripsi XOR
- Data yang dimasukkan user akan dienkripsi menggunakan teknik XOR.
- Data tetap dalam bentuk terenkripsi di database.
- Saat ditampilkan di halaman web, data otomatis didekripsi.

 ✏ CRUD Lengkap
- Create (Tambah data)
- Read (Lihat data terenkripsi → ditampilkan hasil dekripsi)
- Update (Edit data)
- Delete (Hapus data)

🔎 Pencarian Data
- Cari data berdasarkan nama ataupun alamat (setelah didekripsi).

📄 Pagination
- Data dibatasi per halaman (5 per halaman).
- Ada tombol Previous / Next.

Log Enkripsi / Dekripsi
- Setiap enkripsi disimpan sebagai log.
- Log disimpan dalam tabel `logs`.
- Halaman `log.php` menampilkan semua proses enkripsi/dekripsi.

🛡 Validasi Input
- Mencegah input kosong.
- Menyaring input dengan aman sebelum diproses.

🎨 Tampilan Bootstrap
UI rapi, responsif, dan mudah digunakan.

📂 Struktur Folder Project

kriptografi_xor/
│-- index.php
│-- db.php
│-- functions.php
│-- create.php
│-- read.php
│-- update.php
│-- delete.php
│-- log.php

db_kripto.sql (dump database)

🧬 Cara Kerja Enkripsi XOR

Metode XOR menggunakan operasi bitwise:

cipher = plaintext XOR key
plaintext = cipher XOR key

Karena XOR reversible, proses enkripsi dan dekripsi menggunakan fungsi yang sama.

Di project ini, fungsi XOR berada pada `functions.php`:

```php
function xor_encrypt($data, $key = "kunci123") {
    $output = '';
    for ($i = 0; $i < strlen($data); $i++) {
        $output .= chr(ord($data[$i]) ^ ord($key[$i % strlen($key)]));
    }
    return $output;
}
- -


⚙ Cara Menjalankan Aplikasi
1. Install XAMPP
Pastikan Apache dan MySQL berjalan.
2. Pindahkan folder project
Letakkan folder project ke:
xampp/htdocs/
atau (tergantung instalasi XAMPP kamu)
C:/xampp/Ks/htdocs/
3. Import Database
1.	Buka http://localhost/phpmyadmin
2.	Buat database dengan nama:
3.	db_kripto
4.	Klik tab Import
5.	Upload file:
6.	db_kripto.sql
4. Akses Aplikasi di Browser
http://localhost/kriptografi_xor/
🗃 Tabel Database
1. Tabel users
Menampung data terenkripsi:
•	id (INT)
•	nama (TEXT)
•	alamat (TEXT)
2. Tabel logs
Menyimpan proses enkripsi:
•	id
•	action (encrypt/decrypt)
•	plaintext
•	ciphertext
•	created_at

✨ Selesai
Aplikasi berjalan lengkap dengan:
•	CRUD
•	XOR Encryption
•	Pagination
•	Search
•	Log encryption
•	Validasi input
•	Bootstrap UI

🧑‍💻 Dibuat oleh:
Nama: Jendriadi
Kelas: IF-502 Prodi PJJ Informatika
