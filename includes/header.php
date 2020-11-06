<?php require 'includes/functions.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link rel="stylesheet" href="assets/css/main.css">
    <title> Stuliday </title>
</head>

<body>
    <nav class="navbar" role="navigation" aria-label="main navigation" style="background-color: grey;">
        <div class="navbar-brand">
            <a class="navbar-item" href="index.php">
                <img src="images/stuliday-logo-dark.png" width=50 height=50>
            </a>

            <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false"
                data-target="navbarBasicExample">
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
            </a>
        </div>

        <div id="navbarBasicExample" class="navbar-menu">
            <div class="navbar-start">
                <a class="navbar-item" href="index.php">
                    Home
                </a>

                <a class="navbar-item" href="ads.php">
                    Places to stay
                </a>
            </div>

            <div class="navbar-end">
                <?php
            if (!empty($_SESSION)) {
                ?>
                <div class="navbar-item has-dropdown is-hoverable bg-is-primary">
                    <a class="navbar-link">
                        <?php echo $_SESSION['fullname']; ?>
                    </a>

                    <div class="navbar-dropdown mr-1">
                        <a class="navbar-item" href="profil.php">
                            My Profile
                        </a>
                        <a class="navbar-item" href="publisher.php">
                            Publish Ads
                        </a>
                        <hr class="navbar-divider">
                        <a class="navbar-item" href="?logout">
                            Disconnect
                        </a>
                    </div>
                </div>
                <?php
            } else {
                ?>
                <div class="navbar-item">
                    <div class="buttons">
                        <a class="button is-primary" href="signin.php">
                            <strong>Sign in</strong>
                        </a>
                    </div>
                </div>
                <?php
            }
            ?>
            </div>
        </div>
    </nav>