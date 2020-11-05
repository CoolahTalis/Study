<?php

    // VARS WITHIN PDO METHOD ..
    $servername = 'localhost';
    $dbname = 'stuliday';
    $username = 'root';
    $password = '';
    //ATTEMPT TO REACH DATABASE ..
    try {
        $conn = new PDO("mysql:host={$servername};dbname={$dbname}", $username, $password);
        //SETTING PDO ERROR MODE ON EXCEPTION ..
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        session_start();
        // IF ATTEMPT FAIL CATCH ERROR / DISPLAY IT ..
    } catch (PDOException $e) {
        echo 'Error : '.$e->getMessage();
    }
        //IF LOGOUT IS SET, DESTROY USER'S SESSION & REDIRECT HIM ON LANDING PAGE ..
    if (isset($_GET['logout'])) {
        session_destroy();
        header('Location: index.php');
    }
