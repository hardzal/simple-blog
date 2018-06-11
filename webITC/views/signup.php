<?php include "./assets/layout/header-white.php"; ?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-4 m-auto p-md-4 rounded form">
            <div><h2 class="text-center">Sign Up</h2></div>
            <form method="POST" action="">
                <div class="form-group">
                <?php
                $form_token = md5( uniqid('auth', true) );
                $_SESSION['form_token'] = $form_token;
                    if(isset($_POST['submit'])) {
                        $user->register();
                    }
                ?>
                    <label for="nama">Name</label>
                    <input type="text" class="form-control" id="nama" placeholder="Name" maxlength='100' required/>
                </div>
                <div class="form-group">
                    <label for="nim">NIM</label>
                    <input type="number" class="form-control" id="nim" placeholder="NIM" maxlength='12' required/>
                </div>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="username" class="form-control" id="username" placeholder="username" maxlength='32' required/>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" maxlength='100' required/>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" maxlength='100' required/>
                </div>
                <input type="hidden" name="form_token" value="<?php echo $form_token;?>"/>
                <button type="submit" class="btn btn-primary" name="submit">Submit</button>
            </form>
        </div>
    </div>
</div>

<script src="https://unpkg.com/ionicons@4.1.2/dist/ionicons.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>