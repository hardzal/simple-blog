<?php
if (!$cekLogin) {
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
            <a href="dashboard&p=post" class="btn btn-outline-success btn-block p-2 active">
                <ion-icon name="paper"></ion-icon>Posts
            </a>
            <a href="dashboard&p=post_add" class="btn btn-outline-success btn-block p-2 active">
                <ion-icon name="create"></ion-icon> Create Post
            </a>
            <a href="dashboard&p=categories" class="btn btn-outline-success btn-block p-2 active">
                <ion-icon name="pricetags"></ion-icon> Categories
            </a>
            <a href="dashboard&p=members" class="btn btn-outline-success btn-block p-2 active">
                <ion-icon name="contacts"></ion-icon> Members
            </a>
            <a href="dashboard&p=comments" class="btn btn-outline-success btn-block p-2 active">
                <ion-icon name="chatboxes"></ion-icon> Comments
            </a>
            <a href="dashboard&p=settings" class="btn btn-outline-success btn-block p-2 active">
                <ion-icon name="contact"></ion-icon> Settings
            </a>
        </div>
        <div class="col-10 p-4">
            <?php
            $p = isset($_GET['p']) ? $_GET['p'] : "";

            if (empty($p)) {
                $p = "post";
            }

            $p = filter_var($p, FILTER_SANITIZE_STRING);
            switch ($p) {
                case "post":
                    ?>

            <?php
                if (isset($_SESSION['message'])) {
                    ?>

            <div class="row">
                <div class="col">
                    <div class="alert alert-success mb-3 ">
                        <?= $_SESSION['message']; ?>
                    </div>
                </div>
            </div>
            <?php unset($_SESSION['message']);
                } ?>
            <div class="row blog">
                <?php
                    $data = $post->showPost('created_at');
                    if (is_array($data)) {
                        foreach ($data as $value) {
                            ?>
                <div class="col-md-4 mb-5">
                    <div class="img-thumbnail border-0">
                        <div class="row">
                            <div class="col">
                                <h4 class="mb-2 font-weight-bold"><?php echo $value['judul']; ?></h4>
                                <p><?php echo substr($value['isi'], 0, 25); ?></p>
                                <a href="dashboard&p=post_update&id=<?php echo $value['id']; ?>" class="btn btn-primary btn-sm">Edit</a>
                                <a href="dashboard&p=post_del&id=<?php echo $value['id']; ?>" class="btn btn-danger btn-sm" onClick='return confirm("Are you sure delete post?")'>Hapus</a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                        }
                    } else {
                        echo "<p>Belum ada post!</p>";
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
                        if (isset($_POST['submit'])) {
                            $post->addPost();
                        }
                        ?>
                    <form method="post" action="" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="judul">Judul</label>
                            <input type="text" class="form-control" placeholder="Judul" name="judul" required />
                        </div>
                        <div class="form-group">
                            <label for="kategori">Kategori</label><br>
                            <select name="kategori">
                                <option value=''>Pilih Kategori</option>
                                <?php
                                    $list_categories = $category->showCategories();

                                    foreach ($list_categories as $value) {
                                        ?>
                                <option value='<?= $value['id']; ?>'><?= $value['nama']; ?></option>
                                <?php
                                    }
                                    ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="gambar">Gambar</label>
                            <input type="file" class="form-control-file" placeholder="" name="img" required />
                        </div>
                        <input type="hidden" value="<?php echo $_SESSION['user_id']; ?>" name="user_id" />
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
                        if (isset($_GET['id']) && !empty($_GET['id'])) {
                            $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
                            $value = $post->selectPost($id);

                            if (isset($_POST['submit'])) {
                                $post->updatePost();
                            }
                            ?>
                    <form method="post" action="" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="judul">Judul</label>
                            <input type="text" class="form-control" placeholder="Judul" name="judul" value="<?php echo $value['judul']; ?>" required />
                        </div>
                        <div class="form-group">
                            <label for="kategori">Kategori</label><br>
                            <select name="kategori">
                                <option value=''>Pilih Kategori</option>
                                <?php
                                        $list_categories = $category->showCategories();
                                        $selected = $category->selectCategory($value['category_id']);
                                        foreach ($list_categories as $kategori) {
                                            ?>
                                <option value='<?= $kategori['id']; ?>' <?php if ($kategori['id'] == $selected['id']) echo "selected"; ?>>
                                    <?= $kategori['nama']; ?></option>
                                <?php
                                        }
                                        ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="gambar">Gambar</label>
                            <div class="row">
                                <div class="col">
                                    <img src="assets/img/<?php echo $value['img']; ?>" width="300" style="border: 1px solid #ddd; padding: 3px; margin-bottom: 5px;" />
                                </div>
                            </div>
                            <input type="file" class="form-control-file" placeholder="" name="img" />
                        </div>
                        <div class="form-group">
                            <label for="konten">Konten</label>
                            <textarea name="isi" id="konten" class="form-control" rows="15" required><?php echo $value['isi']; ?></textarea>
                        </div>
                        <input type="hidden" value="<?php echo $_SESSION['user_id']; ?>" name="user_id" />
                        <input type="hidden" value="<?php echo $value['id']; ?>" name="id" />
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
                if (isset($_GET['id']) && !empty($_GET['id'])) {
                    $post->deletePost($_GET['id']);
                    $message = "Berhasil menghapus post!";

                    $this->setMessage($message);
                    $_SESSION['message'] = $this->getMessage();
                } else {
                    header("Location: dashboard");
                }
                ?>

            <?php
                break;
            case "categories":
                ?>
            <h2>List Categories</h2>
            <?php if (isset($_SESSION['message'])) : ?>
            <div class="row">
                <div class="col">
                    <div class="alert alert-success mb-3 ">
                        <?= $_SESSION['message']; ?>
                    </div>
                </div>
            </div>
            <?php endif; ?>
            <a href='dashboard&p=categories_add' class="btn btn-success mb-3">Create category</a>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Name</th>
                        <th scope="col">Keterangan</th>
                        <th scope="col">Option</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $data = $category->showCategories();

                        if (is_array($data)) {
                            $no = 0;
                            foreach ($data as $value) {
                                $no = $no + 1;
                                ?>
                    <tr>
                        <td scope="row"><?= $no; ?></td>
                        <td scope="row"><?php echo $value['nama']; ?></td>
                        <td scope="row"><?= $value['keterangan']; ?></td>
                        <td scope="row">
                            <a href='dashboard' class='btn btn-info'>Show</a> | <a href='dashboard&p=categories_update&id=<?= $value['id']; ?>' class='btn btn-primary'>Edit</a> | <a href='dashboard&p=categories_delete&id=<?= $value['id']; ?>' class='btn btn-danger'>Delete</a></td>
                    </tr>
                    <?php
                            }
                        } else {
                            echo "Belum ada kategori";
                        }
                        ?>
                </tbody>
            </table>
            <?php
                break;
            case "categories_add":
                ?>
            <h2>Create Category</h2>
            <form method="post" action="">
                <?php
                    if (isset($_POST['submit'])) {
                        $category->addCategory();
                    }
                    ?>
                <div class="form-group">
                    <label for="name">Nama</label>
                    <input type="text" class="form-control" name="nama">
                </div>
                <div class="form-group">
                    <label for="keterangan">Keterangan</label>
                    <textarea name="keterangan" id="keterangan_kategori" class="form-control" rows="10" required></textarea>
                </div>
                <input type="submit" class="btn btn-primary" value="Submit" name="submit">
            </form>
            <?php
                break;
            case "categories_update":
                if (isset($_GET['id']) && !empty($_GET['id'])) {
                    $values = $category->selectCategory($_GET['id']);
                    ?>
            <h2>Edit Category</h2>
            <form method="post" action="">
                <?php
                        if (isset($_POST['submit'])) {
                            $category->updateCategory();
                        }
                        ?>
                <div class="form-group">
                    <label for="name">Nama</label>
                    <input type="text" class="form-control" name="nama" value="<?= $values['nama']; ?>">
                </div>
                <div class="form-group">
                    <label for="keterangan">Keterangan</label>
                    <textarea name="keterangan" id="keterangan_kategori" class="form-control" rows="15" required><?= $values['keterangan']; ?></textarea>
                    <input type='hidden' name='id' value=<?= $values['id']; ?> />
                </div>
                <input type="submit" class="btn btn-primary" value="Submit" name="submit">
            </form>
            <?php
                }
                break;
            case "categories_delete":
                if (isset($_GET['id']) && !empty($_GET['id'])) {
                    $category->deleteCategory($_GET['id']);
                } else {
                    header("Location: dashboard");
                }
                break;
            case "settings":
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
            case "members":
                $data = $user->showMembers();
                if (is_array($data)) {
                    $no = 0;
                    ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Username</th>
                        <th scope="col">Email</th>
                        <th scope="col">Name</th>
                        <th scope="col">NIM</th>
                        <th scope="col">Option</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                            foreach ($data as $value) {
                                $no = $no + 1;
                                ?>
                    <tr>
                        <th scope="row"><?= $no; ?></th>
                        <td><?= $value['username']; ?></td>
                        <td><?= $value['email']; ?></td>
                        <td><?= $value['nama_lengkap']; ?></td>
                        <td><?= $value['nim']; ?></td>
                        <td><a href='dashboard&p=member_edit&id=<?= $value['id']; ?>' class="btn btn-primary" style="color:white;">Edit</a> | <a href='dashboard&p=member_delete&id=<?= $value['id']; ?>' class="btn btn-danger" style="color:white;">Delete</a></td>
                    </tr>
                    <?php
                            }
                        } else {
                            echo "Belum ada member";
                        }
                        ?>
                </tbody>
            </table>
            <?php
                break;
            case "member_edit":
                if (isset($_POST['submit'])) {
                    $user->updateData();
                }

                $id    = strip_tags(trim($_GET['id']));
                $value = $user->selectMember($id);
                ?>
            <form method="POST" action="" autocomplete="off">
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name='email' placeholder="Enter email" maxlength='100' value="<?= $value['email']; ?>" />
                </div>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" value="<?= $value['username']; ?>" maxlength='32' name='username' />
                </div>
                <div class="form-group">
                    <label for="nim">NIM</label>
                    <input type="text" class="form-control" id="nim" value="<?= $value['nim']; ?>" maxlength='10' name='nim' />
                </div>
                <div class="form-group">
                    <label for="nama_lengkap">Nama Lengkap</label>
                    <input type="text" class="form-control" id="nama_lengkap" value="<?= $value['nama_lengkap']; ?>" maxlength='32' name='nama' />
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name='password' maxlength='100' />
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword2">Confirm Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword2" placeholder="Confirm Password" name='password_confirm' maxlength='100' />
                </div>
                <button type="submit" class="btn btn-primary" name="submit">Submit</button>
            </form>
            <?php
                break;
            case "member_delete":
                $id = strip_tags(trim($_GET['id']));

                $user->deleteMember($id);
                break;
            case "comments":
                ?>
            <p>Belum ada komentar</p>
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