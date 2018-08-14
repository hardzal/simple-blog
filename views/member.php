<?php
    if(!$cekLogin) {
        echo "<script>alert('Anda belum melakukan login!')</script>";
        header("Location: login");
    } else {
        if(!$user->checkLevel()) {
            header("Location: home");
        }
        if ($user->checkLevel() == 'A') {
            header("Location: dashboard");
        } 
    }
    require_once "./assets/layout/header-white.php";
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-2 bg-dark sidebar py-3">
            <a href="?p=settings" class="btn btn-outline-success btn-block p-2 active"><ion-icon name="create"></ion-icon> Settings</a>
        </div>
        <div class="col-10 p-4">
            <p> Selamat Datang! </p>
        </div>
    </div>
</div>
