<?php
    if(!$cekLogin) {
        echo "<script>alert('Anda belum melakukan login!')</script>";
        header("Location: login");
    } 
    if ($user->checkLevel() == 'U') {
        header("Location: member");
    } 
    require_once "./assets/layout/header-white.php";
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-2 bg-dark sidebar py-3">
            <a href="dashboard&p=post" class="btn btn-outline-success btn-block p-2"><ion-icon name="paper"></ion-icon>Posts</a>
            <a href="dashboard&p=post_add" class="btn btn-outline-success btn-block p-2 active"><ion-icon name="create"></ion-icon> Create Post</a>
            <a href="dashboard&p=post_add" class="btn btn-outline-success btn-block p-2 active"><ion-icon name="create"></ion-icon> Settings</a>
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
                                <a href="dashboard&p=post_update&id=<?php echo $value['id'];?>" class="btn btn-primary btn-sm">Edit</a>
                                <a href="dashboard&p=post_del&id=<?php echo $value['id'];?>" class="btn btn-danger btn-sm" onClick='return confirm("Are you sure delete post?")'>Hapus</a>  
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
                            <input type="text" class="form-control" placeholder="Judul" name="judul" required/>
                        </div>
                        <div class="form-group">
                            <label for="gambar">Gambar</label>
                            <input type="file" class="form-control-file" placeholder="" name="img" required/>
                        </div>
                        <div class="form-group">
                            <label for="konten">Konten</label>
                            <textarea name="isi" id="konten" class="form-control" rows="15" required></textarea>
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        <?php
                break;
                case "post_update":
        ?>
                <div class="row">
                <div class="col-md-10 d-block m-auto">
                <?php
                    if(isset($_GET['id'])&&!empty($_GET['id'])) {
                        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
                        $value = $post->selectPost('post_masters', $id);

                        if(isset($_POST['submit'])) {
                            $post->updatePost($_POST['judul'], $_POST['isi'], $_FILES['img'], 1, $_SESSION['user_id'], 'post_masters', $_GET['id']);
                        }
                ?>
                    <form method="post" action="" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="judul">Judul</label>
                            <input type="text" class="form-control" placeholder="Judul" name="judul" value="<?php echo $value['judul'];?>" required/>
                        </div>
                        <div class="form-group">
                            <label for="gambar">Gambar</label>
                            <input type="file" class="form-control-file" placeholder="" name="img"/>
                        </div>
                        <div class="form-group">
                            <label for="konten">Konten</label>
                            <textarea name="isi" id="konten" class="form-control" rows="15" required><?php echo $value['isi'];?></textarea>
                        </div>
                        <input type="hidden" value="<?php echo $value['id'];?>" name="id"/>
                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                    </form>
                  
                <?php
                    } else {
                        header('Location: dashboard');
                    }   
                ?>
                </div>
            </div>
        <?php 
                break;
                case "post_del":
                if(isset($_GET['id'])&&!empty($_GET['id'])) {
                    $post->deletePost('post_masters', $_GET['id']);
                } else {
                    header("Location: dashboard");
                }
        ?>

        <?php
                break;
                case "settings":
        ?>
                <form method="post" action="">
                    
                </form>
        <?php
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
