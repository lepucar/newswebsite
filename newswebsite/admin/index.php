<?php

error_reporting(-1);
require_once "../config/helper.php";
require_once "../connection/database.php";

if (!isset($_SESSION['user']) && !$_SESSION['is_login']) {
    header("Location:" . base_url());
    exit();
}






?>

<!DOCTYPE html>

<html>

<head>
    <title> Admin Panel </title>
    <link rel="stylesheet" href="public/css/style.css">

</head>

<body>
    <div class="container-main">


        <div class="header">
            <div class="container">
                <div class="logo">
                    <a href=""><img src="../public/images/cnnlogo.png"></a>
                </div>

                <div class="menu">
                    <ul>
                        <li><a href="">Home</a></li>
                        <li><a href="">News</a></li>
                        <li><a href="">Contact</a></li>
                        <li><a href="<?= admin_url("logout") ?>">Logout</a></li>

                    </ul>
                </div>
            </div>


        </div>
        <div class="sidebar-main">


            <div class="aside">
                <div class="sidebar-container">
                    <div class="user-profile">
                        <div class="image-box">
                            <img src="<?= public_url("users/".$_SESSION['user']['image']); ?>" alt="user" height="50px" width="50px">
                        </div>
                        <div class="name-box">
                            <h3><?= $_SESSION['user']['fname']." ".$_SESSION['user']['lname']; ?></h3>
                        </div>

                    </div>
                    <h2 id="txt-sidebar">Controls</h2>
                    <ul class="control-menu">
                        <li><a href="<?= admin_url('adduser'); ?>">Add User</a></li>
                        <li><a href="<?= admin_url('showuser'); ?>">Show User</a></li>
                        <li><a href="<?= admin_url('managecategory'); ?>">Manage Category</a></li>
                        <li><a href="<?= admin_url('managenews'); ?>">Manage News</a></li>
                        <li><a href="">Account</a></li>
                        <li><a href="">Logout</a></li>
                    </ul>

                </div>
            </div>

            <div class="main">

                <?php
                $uri = $_GET['uri'] ?? 'dashboard';
                $uri = str_replace('.php', '', $uri);

                $uri = $uri . '.php';

                $pagePath = "pages/$uri";


                if (file_exists($pagePath) && is_file($pagePath)) {
                    include $pagePath;
                } else {
                    include 'pages/404.php';
                }
                ?>

            </div>

        </div>
    </div>
</body>

</html>