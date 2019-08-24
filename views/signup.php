<?php include "./layout/header-white.php"; ?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-4 m-auto p-md-4 rounded form">
            <div>
                <h2 class="text-center">Sign Up</h2>
            </div>
            <form method="POST" action="" autocomplete="off">
                <?php
                if (isset($_POST['submit'])) {
                    $user->register();
                }
                ?>
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address <span style="color:red;">*</span></label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name='email' placeholder="Enter email" maxlength='100' required />
                </div>
                <div class="form-group">
                    <label for="username">Username <span style="color:red;">*</span></label>
                    <input type="username" class="form-control" id="username" placeholder="username" maxlength='32' name='username' required />
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password <span style="color:red;">*</span></label>
                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name='password' maxlength='100' required />
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword2">Confirm Password <span style="color:red;">*</span></label>
                    <input type="password" class="form-control" id="exampleInputPassword2" placeholder="Password" name='password_confirm' maxlength='100' required />
                </div>
                <button type="submit" class="btn btn-primary" name="submit">Submit</button>
            </form>
        </div>
    </div>
</div>

<script src="https://unpkg.com/ionicons@4.1.2/dist/ionicons.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>