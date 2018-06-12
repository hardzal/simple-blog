<?php
    if(!$cekLogin) {
        echo "<script>alert('Anda belum melakukan login!')</script>";
        header("Location: login");
    } else {
        if ($user->checkLevel() == 'U') {
            return true;
        } else if ($user->checkLevel() == 'A') {
            header("Location: dashboard");
        } else {
            header("Location: login");
        }
    }
    require_once "./assets/layout/header-white.php";
?>
<p>Hello!!</p>