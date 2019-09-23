<?php
if (!$cekLogin) {
    echo "<script>alert('Anda belum melakukan login!')</script>";
    header("Location: ./login");
} else {
    if (!$user->checkLevel()) {
        header("Location: home");
    }
    if ($user->checkLevel() == 'A') {
        header("Location: ./dashboard");
    }
}
require_once "./views/layout/header-white.php";
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-2 bg-dark sidebar py-3">
            <a href="member&p=settings" class="btn btn-outline-success btn-block p-2 active">
                <ion-icon name="create"></ion-icon> Settings
            </a>
        </div>
        <div class="col-10 p-4">
            <?php
            $page = isset($_GET['p']) ? $_GET['p'] : '';
            if (empty($page)) $page = 'home';
            $page = filter_var($page, FILTER_SANITIZE_STRING);

            switch ($page) {
                case 'home':
                    echo "<p> Selamat Datang! </p>";
                    break;
                case 'settings':
                    $user = new User();
                    $values = $user->showData();
                    ?>
                    <h2>Settings</h2>
                    <form method="post" action="">
                        <?php
                            if (isset($_POST['submit'])) {
                                $user->updateData();
                            }
                            ?>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" class="form-control" name="email" value="<?= $values['email']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="newPassword">Password</label>
                            <input type="password" class="form-control" placeholder="New password" name="new_password"><br>
                            <label for="confirmNewPassword">Confirm Password</label>
                            <input type="password" class="form-control" placeholder="Confirm password" name="confirm_password">
                        </div>
                        <div class="form-group">
                            <label for="nama">Nama Lengkap</label>
                            <input type="text" class="form-control" value="<?= $values['nama_lengkap']; ?>" name="nama">
                        </div>
                        <div class="form-group">
                            <label for="nim">NIM</label>
                            <input type="text" class="form-control" value="<?= $values['nim']; ?>" name="nim">
                            <input type="hidden" value="<?= $_SESSION['user_id']; ?>" name="id" />
                        </div>
                        <input type="submit" class="btn btn-primary" value="Submit" name="submit">
                    </form>
                <?php
                    break;
            }
            ?>
        </div>
    </div>
</div>