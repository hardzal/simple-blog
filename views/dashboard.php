<?php
    if(!$cekLogin) {
        echo "<script>alert('Anda belum melakukan login!')</script>";
        header("Location: login");
    } else {
       if ($user->checkLevel() == 'U') {
            header("Location: member");
        } 
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
            <?php
                $data = $post->showPost('post_masters', 'created_at');
                if(is_array($data)) {
                    foreach($data as $value) {
            ?>
                <div class="col-md-4 mb-5">
                    <div class="img-thumbnail border-0">
                        <div class="row">
                            <div class="col">
                                <h4 class="mb-2 font-weight-bold"><?php echo $value['judul'];?></h4>
                                <p><?php echo substr($value['isi'], 0, 25);?></p> 
                                <a href="&id=<?php echo $value['id'];?>" class="btn btn-primary btn-sm">Edit</a>
                                <a href="&id=<?php echo $value['id'];?>" class="btn btn-danger btn-sm">Hapus</a>  
                            </div>
                        </div>
                    </div>
                </div>
            <?php 
                    }
                }
            ?>
            </div>
        <?php
                break;
                case "post_add":
        ?>
            <div class="row">
                <div class="col-md-10 d-block m-auto">
                <?php
                    if(isset($_POST['submit'])) {
                        $post->addPost($_POST['judul'], $_POST['isi'], $_FILES['img'], 1, $_SESSION['user_id']);
                    }
                ?>
                    <form method="post" action="" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="judul">Judul</label>
                            <input type="text" class="form-control" placeholder="Judul" name="judul"/>
                        </div>
                        <div class="form-group">
                            <label for="gambar">Gambar</label>
                            <input type="file" class="form-control-file" placeholder="" name="img"/>
                        </div>
                        <div class="form-group">
                            <label for="konten">Konten</label>
                            <textarea name="isi" id="konten" class="form-control" rows="15"></textarea>
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
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
                    $user->logout();
                break;
                default:
                    header("Location: home");
            }
        ?>
        </div>
    </div>
</div>
