# ANALISIS KEBUTUHAN SISTEM PADA APLIKASI DI-LEMAS

## A. Requirement

Aplikasi Di-LeMas ini menggunakan CodeIgniter 4.4.1 dan PHP 8.1.

### a. Prasyarat
1. PHP 7.4 atau versi diatasnya.
2. Composer.
3. GIT.
4. Local Server (XAMPP atau Laragon).
5. Extenstion PHP: intl, mbstring.

### b. Instalasi
1. Clone repository dengan cara buka folder htdocs atau www (jika kamu menggunakan laragon). Lalu klik kanan, pilih git bash here habis itu, ketikkan atau copas `git clone https://github.com/fahrianggara/wp2.git`.
2. Jika sudah, ketikkan `cd wp2` untuk masuk ke folder yang baru di clone, lalu ketikkan lagi `cd lms`, abis itu jalankan perintah `composer install` atau bisa juga `composer update`.
3. Sekarang buka phpmyadmin untuk membuat database baru dengan nama `ci_dilemas`.
4. Jika sudah, balik lagi ke terminal git bash lalu ketikkan `code .` Untuk membuka text editor (vscode).
5. Ganti file `.env.example` jadi `.env`.
6. Konfigurasikan file `.env` sebagai berikut:
```env
# --------------------------------------------------------------------
# ENVIRONMENT
# --------------------------------------------------------------------

CI_ENVIRONMENT = development

# --------------------------------------------------------------------
# APP
# --------------------------------------------------------------------

app.baseURL = 'http://localhost:8080'
# If you have trouble with `.`, you could also use `_`.
# app_baseURL = ''
# app.forceGlobalSecureRequests = false
# app.CSPEnabled = false

# --------------------------------------------------------------------
# DATABASE
# --------------------------------------------------------------------

database.default.hostname = localhost
database.default.database = ci_dilemas
database.default.username = root
database.default.password =
database.default.DBDriver = MySQLi
# database.default.DBPrefix =
# database.default.port = 3306
```
7. Balik ke git bash terminal lalu ketikkan perintah php spark migrate jika sudah ketikkan lagi php spark db:seed Run. Dan jangan lupa untuk mengaktifkan MySQL pada Local Server.
8. Selanjutnya jalankan/ketikkan perintah php spark serve Dan aplikasi Di-LeMas akan berjalan pada url http://localhost:8080.

### c. Fitur

#### Admin

- [X] Autentikasi (Login & Logout)
- [x] Edit Profile (Foto Profile & Password)
- [x] Melihat & Mengelola Data Guru
- [x] Melihat & Mengelola Data Siswa
- [x] Melihat & Mengelola Data Kelas
- [x] Melihat & Mengelola Data Mata Pelajaran
- [x] Melihat & Mengelola Data Jadwal

#### Guru

- [x] Autentikasi (Login & Logout)
- [x] Edit Profile (Foto Profile & Password)
- [x] Melihat & Mengelola Data Materi

#### Siswa

- [x] Autentikasi (Login & Logout)
- [x] Edit Profile (Foto Profile & Password)
- [x] Melihat Data Materi

## Entity Relationship Table (ERD)

<p><a href="https://github.com/fahrianggara/wp2/blob/main/lms/public/images/erd.png?raw=true" target="_blank"><img src="https://github.com/fahrianggara/wp2/blob/main/lms/public/images/erd.png?raw=true"></a></p>

## Kontributor

- [10220009 - Fahri Anggara](https://fahrianggara.my.id/)