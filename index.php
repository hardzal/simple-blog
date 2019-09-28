<?php
ob_start();
session_start();
error_reporting(0);

define('ACCESS', 1);

require_once __DIR__ . "/inc/Database.php";
require_once __DIR__ . "/inc/User.php";
require_once __DIR__ . "/inc/Post.php";
require_once __DIR__ . "/inc/Category.php";
require_once __DIR__ . "/inc/Comment.php";

$user = new User();
$post = new Post();
$category = new Category();
$comments = new Comment();

$cekLogin = $user->isLogin();

require_once __DIR__ . "/views/layout/meta.php";

$page = isset($_GET['page']) ? $_GET['page'] : "";

if (!empty($page)) {
    require_once  __DIR__ . "/views/" . $page . ".php";
} else {
    require_once __DIR__ . "/views/home.php";
}

require_once __DIR__ . "/views/layout/footer.php";
