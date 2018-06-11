<?php
    if(!$cekLogin) {
        echo "<script>alert('Anda belum melakukan login!')</script>";
        header("Location: login");
    }

    require_once "./assets/layout/header-white.php";
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-2 bg-dark sidebar py-3">
            <a href="dashboard&p=post" class="btn btn-outline-success btn-block p-2"><ion-icon name="paper"></ion-icon> Blogs</a>
            <a href="dashboard&p=post_add" class="btn btn-outline-success btn-block p-2 active"><ion-icon name="create"></ion-icon> Create Post</a>
        </div>
        <div class="col-10 p-4">
            <p> Selamat Datang! </p>
        <?php
            $p = isset($_GET['p']) ? $_GET['p'] : "";

            if(empty($p)) {
                $p = "post";
            }

           // $p = filter_var($p, FILTER_SANITIZE_STRING);
            switch($p) {
                case "post":
        ?>
            <div class="row blog">
                <div class="col-md-4 mb-5">
                    <div class="img-thumbnail border-0">
                        <div class="row">
                            <div class="col-md-5 mb-2">
                                <img src="https://images.pexels.com/photos/577585/pexels-photo-577585.jpeg?cs=srgb&dl=coding-computer-data-577585.jpg&fm=jpg" alt="">
                            </div>
                            <div class="col">
                                <h4 class="mb-2 font-weight-bold">Judul Blog</h4>
                                <p>Ini adalah blog asjdasjd</p>                   
                                <a href="blog.php" class="btn btn-primary btn-sm">Edit</a>
                                <a href="blog.php" class="btn btn-danger btn-sm">Hapus</a>  
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-5">
                    <div class="img-thumbnail border-0">
                        <div class="row">
                            <div class="col-md-5 mb-2">
                                <img src="https://images.pexels.com/photos/577585/pexels-photo-577585.jpeg?cs=srgb&dl=coding-computer-data-577585.jpg&fm=jpg" alt="">
                            </div>
                            <div class="col">
                                <h4 class="mb-2 font-weight-bold">Judul Blog</h4>
                                <p>Ini adalah blog asjdasjd</p>                   
                                <a href="blog.php" class="btn btn-primary btn-sm">Edit</a>
                                <a href="blog.php" class="btn btn-danger btn-sm">Hapus</a>  
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-5">
                    <div class="img-thumbnail border-0">
                        <div class="row">
                            <div class="col-md-5 mb-2">
                                <img src="https://images.pexels.com/photos/577585/pexels-photo-577585.jpeg?cs=srgb&dl=coding-computer-data-577585.jpg&fm=jpg" alt="">
                            </div>
                            <div class="col">
                                <h4 class="mb-2 font-weight-bold">Judul Blog</h4>
                                <p>Ini adalah blog asjdasjd</p>                   
                                <a href="blog.php" class="btn btn-primary btn-sm">Edit</a>
                                <a href="blog.php" class="btn btn-danger btn-sm">Hapus</a>  
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-5">
                    <div class="img-thumbnail border-0">
                        <div class="row">
                            <div class="col-md-5 mb-2">
                                <img src="https://images.pexels.com/photos/577585/pexels-photo-577585.jpeg?cs=srgb&dl=coding-computer-data-577585.jpg&fm=jpg" alt="">
                            </div>
                            <div class="col">
                                <h4 class="mb-2 font-weight-bold">Judul Blog</h4>
                                <p>Ini adalah blog asjdasjd</p>                   
                                <a href="blog.php" class="btn btn-primary btn-sm">Edit</a>
                                <a href="blog.php" class="btn btn-danger btn-sm">Hapus</a>  
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-5">
                    <div class="img-thumbnail border-0">
                        <div class="row">
                            <div class="col-md-5 mb-2">
                                <img src="https://images.pexels.com/photos/577585/pexels-photo-577585.jpeg?cs=srgb&dl=coding-computer-data-577585.jpg&fm=jpg" alt="">
                            </div>
                            <div class="col">
                                <h4 class="mb-2 font-weight-bold">Judul Blog</h4>
                                <p>Ini adalah blog asjdasjd</p>                   
                                <a href="blog.php" class="btn btn-primary btn-sm">Edit</a>
                                <a href="blog.php" class="btn btn-danger btn-sm">Hapus</a>  
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-5">
                    <div class="img-thumbnail border-0">
                        <div class="row">
                            <div class="col-md-5 mb-2">
                                <img src="https://images.pexels.com/photos/577585/pexels-photo-577585.jpeg?cs=srgb&dl=coding-computer-data-577585.jpg&fm=jpg" alt="">
                            </div>
                            <div class="col">
                                <h4 class="mb-2 font-weight-bold">Judul Blog</h4>
                                <p>Ini adalah blog asjdasjd</p>                   
                                <a href="blog.php" class="btn btn-primary btn-sm">Edit</a>
                                <a href="blog.php" class="btn btn-danger btn-sm">Hapus</a>  
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-5">
                    <div class="img-thumbnail border-0">
                        <div class="row">
                            <div class="col-md-5 mb-2">
                                <img src="https://images.pexels.com/photos/577585/pexels-photo-577585.jpeg?cs=srgb&dl=coding-computer-data-577585.jpg&fm=jpg" alt="">
                            </div>
                            <div class="col">
                                <h4 class="mb-2 font-weight-bold">Judul Blog</h4>
                                <p>Ini adalah blog asjdasjd</p>                   
                                <a href="blog.php" class="btn btn-primary btn-sm">Edit</a>
                                <a href="blog.php" class="btn btn-danger btn-sm">Hapus</a>  
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php
                break;
                case "post_add":
        ?>
            <div class="row">
                <div class="col-md-10 d-block m-auto">
                    <form>
                        <div class="form-group">
                            <label for="">Judul</label>
                            <input type="text" class="form-control" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="">Gambar</label>
                            <input type="file" class="form-control-file" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="">Konten</label>
                            <textarea name="" id="" class="form-control" rows="15"></textarea>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        <?php
                break;
                case "post_update":

                break;
                case "post_del":

                break;
                case "member":

                break;
                case "edit_akun":

                break;
                case "logout":
                    unset($_SESSION['user_id']);
                    session_destroy();
                    echo "<script>alert('Success Logout')</script>";
                    header("Location: login");
                break;
                default:
                    header("Location: home");
            }
        ?>
        </div>
    </div>
</div>
