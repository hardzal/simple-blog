
![Travis (.com) branch](https://img.shields.io/travis/com/hardzal/webITC/master.svg) 
![Progress status branch](https://img.shields.io/badge/progress-30%25-yellowgreen.svg)

# Blog
Website Publikasi Kegiatan Kelompok Studi ITC UPNVYK

Untuk Menggunakan Web Ini silahkan di Download atau jika sudah memiliki git bisa diclone melalui command

    git clone https://github.com/hardzal/webITC.git

Kemudian letakkan folder tersebut di server lokal kamu.

Setelah itu buat database dengan perintah berikut
    
    CREATE DATABASE project_webitc

Kemudian sebelum import gunakan perintah berikut 
    
    USE project_webitc

Lalu Import Database SQL <em>project_webitc.sql</em> Dalam hal ini kami menggunakan phpmyadmin

-------------------------------------------------------------------
Data Untuk Login

Sebagai Admin

    email    : admin1@itc.com
    password : 123456
    
Sebagai Member

    email    : member1@itc.com
    password : 7654321
--------------------------------------------------------------------

  # Fitur - Fitur  
  - [ ] CRUD (CREATE, READ, UPDATE, DELETE)
    - tabel_post 
        - [x] Menampilkan Postingan Blog
        - [x] Membuat Postingan Blog
        - [x] Memperbaharui Postingan Blog
        - [x] Menghapus Postingan Blog
    - tabel_user
        - [ ] Mendaftar akun baru (member)
        - [x] Masuk sebagai admin
        - [x] Masuk sebagai member
        - [ ] Memperbaharui data admin
        - [ ] Memperbaharui data member
        - [ ] Menampilkan Member beserta admin (hak akses admin)
  
  - [ ] Searching
  - [ ] Sorting
  - [ ] Pagination
  - [ ] Validation
  - [ ] Authentication

### Rewrite to Laravel [click here](https://github.com/hardzal/itcblog)
