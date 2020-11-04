<?php

    // Vars within the PDO method
    $servername = 'localhost';
    $dbname = 'stuliday';
    $username = 'root';
    $password = '';
    //Attempt to Reach database
    try {
        $conn = new PDO("mysql:host={$servername};dbname={$dbname}", $username, $password);
        //Setting PDO ERRMODE on Exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        session_start();
        // IF attempt fail catch error and display it
    } catch (PDOException $e) {
        echo 'Error : '.$e->getMessage();
    }
        //If logout is set, destroy user's session and redirect him on landing page
    if (isset($_GET['logout'])) {
        session_destroy();
        header('Location: index.php');
    }
