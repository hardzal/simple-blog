# Blog

![Progress status branch](https://img.shields.io/badge/progress-40%25-yellowgreen.svg)

Website Publikasi Kegiatan Kelompok Studi ITC UPNVYK

Untuk Menggunakan Web Ini silahkan di Download atau jika sudah memiliki git bisa diclone melalui command

    git clone https://github.com/hardzal/simple-blog.git

Kemudian letakkan folder tersebut di server lokal kamu.

Setelah itu buat database dengan perintah berikut

    CREATE DATABASE project_webitc

Kemudian sebelum import gunakan perintah berikut

    USE project_webitc

Lalu Import Database SQL *project_webitc.sql* Dalam hal ini kami menggunakan phpmyadmin

-------------------------------------------------------------------
Data Untuk Login

Sebagai Admin

    email    : admin1@itc.com
    password : 1234567              

Sebagai User

    email    : rikakokoe@gmail.com
    password : 987654321

-------------------------------------------------------------------

## Fitur - Fitur  

- Authentication
  - [x] Login
  - [x] Signup
  - [x] Add Email Confirmation
  - [x] Reset password
  - [ ] Remember me
- CRUD (CREATE, READ, UPDATE, DELETE)
  - [x] CRUD posts
  - [x] CRUD users
  - [x] CRUD categories
  - [x] CRUD comments
- Searching
  - [ ] Pencarian data postingan blog
  - [ ] Pencarian data kategori per halaman
  - [ ] Pencarian data member per halaman
- Sorting
  - [ ] Pengurutan data postingan blog
  - [ ] Pengurutan data kategori per halaman
  - [ ] Pengurutan data member per halaman
- Pagination
  - [ ] Menampilkan sebagian postingan blog per halaman
  - [ ] Menampilkan sebagian kategori per halaman
  - [ ] Menampilkan sebagian member per halaman
- Validation
  - [ ] Form Login Validation
  - [ ] Form Signup Validation
  - [ ] Form CRUD Validation
- Exporting
  - [ ] mengekspor data member
  - [ ] mengekspor data post
  - [ ] mengekspor data kategori
  - [ ] mengekspor semua data

### Rewrite to Laravel [click here](https://github.com/hardzal/larablog)
