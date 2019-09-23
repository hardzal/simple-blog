<?php
require_once "./views/layout/header-white.php";
?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-4 m-auto p-md-4 rounded form">
            <div>
                <h2 class="text-center">Forgot Password</h2>
            </div>
            <?php
            if (isset($_POST['submit'])) {
                $user->forgotPassword($_POST['email']);
            }
            if (isset($_SESSION['message'])) : ?>
                <div class="row">
                    <div class="col">
                        <div class="alert alert-danger">
                            <?= $_SESSION['message']; ?>
                        </div>
                    </div>
                </div>
            <?php
                unset($_SESSION['message']);
            endif;
            ?>
            <form method="POST" action="">
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input name="email" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Email" required>
                </div>
                <p>
                    Login? Click
                    <a href='./login'>here</a>
                </p>
                <button type="submit" class="btn btn-primary" name="submit">Submit</button>
            </form>
        </div>
    </div>
</div>

<script src="https://unpkg.com/ionicons@4.1.2/dist/ionicons.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>