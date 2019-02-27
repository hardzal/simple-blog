<?php require_once "./assets/layout/header-white.php";?>
<?php
    $idPost = isset($_GET['id']) ? strip_tags(trim($_GET['id'])) : '';
    $values = $post->selectPost($idPost);
?>
<div class="container mt-5">
    <div class="row mb-5">
        <div class="col-md-10 d-block m-auto blog">
            <h2 class="font-weight-bold mb-4"><?=$values['judul'];?></h2> 
            <img src='assets/img/<?=$values['img'];?>'/>
            <p class="text-justify">
                <?=$values['isi'];?>
            </p>
        </div>
    </div>
    <h2 class="mb-4">Lihat lainnya</h2>
    <div class="row blog">
        <div class="col-md-6 mb-3">
            <div class="img-thumbnail border-0">
                <div class="row">
                    <div class="col-md-5">
                        <img src="https://images.pexels.com/photos/577585/pexels-photo-577585.jpeg?cs=srgb&dl=coding-computer-data-577585.jpg&fm=jpg" alt="">
                    </div>
                    <div class="col">
                        <h4 class="mb-2 font-weight-bold mt-2">Judul Blog</h4>
                        <p>Ini adalah blog asjdasjd ajsdashdhahsd ahsdhhash hasdhhahsdj</p>
                        <a href="/itc/blog.php" class="btn btn-primary">Lihat</a>
                    </div>
                </div>
            </div>
        </div><div class="col-md-6 mb-3">
            <div class="img-thumbnail border-0">
                <div class="row">
                    <div class="col-md-5">
                        <img src="https://images.pexels.com/photos/577585/pexels-photo-577585.jpeg?cs=srgb&dl=coding-computer-data-577585.jpg&fm=jpg" alt="">
                    </div>
                    <div class="col">
                        <h4 class="mb-2 font-weight-bold mt-2">Judul Blog</h4>
                        <p>Ini adalah blog asjdasjd ajsdashdhahsd ahsdhhash hasdhhahsdj</p>
                        <a href="/itc/blog.php" class="btn btn-primary">Lihat</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>