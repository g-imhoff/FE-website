<?php

session_start();

if (isset($_SESSION['username'])) {
    setcookie('username', $_SESSION['username'], time() + 3600 * 24 * 7, '/'); // le cookie reste 7 jours
    setcookie('email', $_SESSION['email'], time() + 3600 * 24 * 7, '/'); // le cookie reste 7 jours
}

if (isset($_COOKIE['username'])) {
    $_SESSION['username'] = $_COOKIE['username'];
    $_SESSION['email'] = $_COOKIE['email'];
}

function connect() {
    $dsn = "mysql:host=localhost;dbname=fe_website";
    $username = "root";
    $password = "";

    try {
        $conn = mysqli_connect('localhost', 'root', '', 'fe_website');
    } catch (PDOexception $e) {
        echo "Connection failed: " . $e->getMessage();
        return false;
    }

    return $conn;
}

?>