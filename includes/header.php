<?php require 'includes/functions.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Stuliday</title>
    <link rel="stylesheet" href="css/main.css">
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
                <div class="navbar-item has-dropdown is-hoverable">
                    <a class="navbar-link">
                        User name
                    </a>

                    <div class="navbar-dropdown">
                        <a class="navbar-item" href="profil.php">
                            My Profile
                        </a>
                        <a class="navbar-item" href="addads.php">
                            Publish New Ads
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