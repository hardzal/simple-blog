<?php require_once "views/header-white.php"; ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-2 bg-dark sidebar py-3">
            <a href="dashboard.php" class="btn btn-outline-success btn-block p-2 active"><ion-icon name="create"></ion-icon> Create Post</a>
            <a href="dashboard-blogs.php" class="btn btn-outline-success btn-block p-2"><ion-icon name="paper"></ion-icon> Blogs</a>
        </div>
        <div class="col-10 p-4">
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
        </div>
    </div>
</div>

<script src="https://unpkg.com/ionicons@4.1.2/dist/ionicons.js"></script>