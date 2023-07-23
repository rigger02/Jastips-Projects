# JASTIPS
Proyek "Jastips" ini yang menggunakan Laravel 8 sebagai backend berfungsi sebagai api dan Ionic Framework sebagai frontend

![N|Solid](https://cldup.com/dTxpPi9lDf.thumb.png)

[![Build Status](https://travis-ci.org/joemccann/dillinger.svg?branch=master)](https://travis-ci.org/joemccann/dillinger)

## JASTIPS
Jastips adalah aplikasi berbasis mobile yang memungkinkan pengguna untuk mencari dan menawarkan jasa titip barang (jastip). Proyek ini menggunakan Laravel 8 sebagai backend dan Ionic Framework sebagai frontend.

## Fitur

- Daftar sebagai pengguna baru
- Login dan autentikasi pengguna
- Mencari jastip yang tersedia
- Menawarkan jastip kepada pengguna lain
- Melihat detail jastip
- Menghubungi pengguna yang menawarkan jastip
- Mengelola daftar jastip yang sedang ditawarkan/dilakukan
- Dan lain-lain

## Data login
berikut merupakan data data login user, seller, driver
### seller
- No hp : 002
- Password : 123

* No hp : 004
* Password : 123

### User
- No hp : 003
- Password : 123

### Driver
* No hp : 005
* Password : 123

## Cara Running
- download source code frontend
- npm i

## Teknologi yang Digunakan

- Laravel 8 (Backend)
- Ionic Framework (Frontend)
- MySQL (Database)
- PHP 7.4 atau versi lebih baru
- Node.js dan npm
- Composer (untuk Laravel)
- Git (untuk version control)

## Instalasi

### Backend (Laravel)

1. Clone atau download repository ini.
2. Pindahkan ke direktori proyek backend dengan perintah `cd jastips-backend`.
3. Salin file `.env.example` menjadi `.env`.
4. Konfigurasi file `.env` sesuai dengan pengaturan database dan lingkungan proyek lainnya.
5. Instal dependensi dengan perintah `composer install`.
6. Jalankan migrasi dan seeder untuk mengisi tabel database dengan perintah `php artisan migrate --seed`.
7. Jalankan server backend dengan perintah `php artisan serve`.

### Frontend (Ionic)

1. Pindahkan ke direktori proyek frontend dengan perintah `cd jastips-frontend`.
2. Instal dependensi dengan perintah `npm install`.
3. Jalankan server frontend dengan perintah `ionic serve`.
4. jalankan `ionic capacitor build [platform]`.
4. jalankan `ionic capacitor add [platform]` untuk gradle

## Kontak

Jika Anda memiliki pertanyaan atau masukan mengenai proyek ini, silakan hubungi kami melalui email di [akangrigger@gmail.com].

## Lisensi

Proyek ini dilisensikan di bawah [MIT License](LICENSE).

**Terima kasih telah berkontribusi pada proyek Jastips!**
