<?php
define('ACCESS', 1);
session_start();

require_once "inc/Database.php";
require_once "inc/User.php";
require_once "inc/Post.php";

$user = new User();
$post = new Post();

$cekLogin = $user->isLogin();

require_once "assets/layout/meta.php";

$page = isset($_GET['page']) ? $_GET['page'] : "";

if(!empty($page)) {
    require_once  "views/".$page.".php";
} else {
    require_once "views/home.php";
}

require_once "assets/layout/footer.php"

?>