# Tugas Individu Project ke-7 (Aplikasi Di-Lemas)

Aplikasi Di-LeMas ini menggunakan CodeIgniter 4.4.1 dan PHP 8.1.

## Prasyarat

- PHP 7.4 atau versi lebih baru.
- [Composer](https://getcomposer.org/).
- [GIT](https://git-scm.com/).
- Local Server seperti [XAMPP](https://www.apachefriends.org/index.html) atau [Laragon](https://laragon.org/).
- Ekstensi PHP: `intl`, dan `mbstring`.

## Instalasi

1. Clone repositori ini atau download repositori ini dalam bentuk ZIP (Di-ekstrak setelah didownload).
2. Buka terminal dan arahkan ke direktori repositori ini.
3. Jalankan perintah `composer install` atau `composer update` untuk mengunduh dependensi.
4. Membuat database baru dengan nama `db_dilemas`.
5. Salin berkas `.env.example` menjadi `.env`.
6. Konfigurasi berkas `.env` sebagai berikut:
```
CI_ENVIRONMENT = development

app.baseURL = 'http://localhost:8080'

database.default.hostname = localhost
database.default.database = db_dilemas
database.default.username = root
database.default.password = 
database.default.DBDriver = MySQLi

# Note: jangan lupa di hapus taggar (#)
```
7. Migrasikan table ke database dengan perintah `php spark migrate` atau `php spark migrate:refresh` Jika sudah lalu ketikkan `php spark db:seed Run`.
8. Jalankan perintah `php spark serve` untuk menjalankan aplikasi. Dan jangan lupa untuk mengaktifkan MySQL pada Local Server.

Aplikasi dapat diakses pada alamat `http://localhost:8080`.

## Fitur

### Admin

- [X] Login
- [x] Logout
- [x] Edit Profile (Foto Profile, Password)
- [x] CRUD Data Guru
- [x] CRUD Data Siswa
- [x] CRUD Data Kelas
- [x] CRUD Data Mata Pelajaran
- [x] CRUD Data Jadwal

### Guru

- [x] Login
- [x] Logout
- [x] Edit Profile (Foto Profile, Password)
- [x] CRUD Data Materi

### Siswa

- [x] Login
- [x] Logout
- [x] Edit Profile (Foto Profile, Password)
- [x] Read Data Materi

## Kontributor

- [10220009 - Fahri Anggara](https://fahrianggara.my.id/)
