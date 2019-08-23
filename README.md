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

-------------------------------------------------------------------

## Fitur - Fitur  

- [x] CRUD (CREATE, READ, UPDATE, DELETE)
  - tabel_post
    - [x] Menampilkan Postingan Blog
    - [x] Membuat Postingan Blog
    - [x] Memperbaharui Postingan Blog
    - [x] Menghapus Postingan Blog
  - tabel_user
    - [x] Mendaftar akun baru (member)
    - [x] Masuk sebagai admin
    - [x] Masuk sebagai member
    - [x] Edit data admin (admin)
    - [x] Edit data member (member)
    - [x] Menampilkan Member beserta admin (admin)

- [ ] Searching
  - [ ] Pencarian data postingan blog
- [ ] Sorting
  - [ ] Pengurutan data postingan blog
- [ ] Pagination
  - [ ] Menampilkan sebagian postingan blog per halaman
- [ ] Authentication
  - [ ] Add Email Confirmation
  - [ ] Reset password
- [ ] Validation
- [ ] Comments 

### Rewrite to Laravel [click here](https://github.com/hardzal/larablog)
