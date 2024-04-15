<?php

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

function disconnect($conn) {
    $conn->close();
}

function checkAccountExist($username, $email) {
    $conn = connect();
    $sql = $conn->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
    $sql->bind_param("ss", $username, $email);
    $sql->execute();
    $result = $sql->get_result();
    $row = $result->fetch_assoc();
    $sql->close();
    disconnect($conn);
    if ($row) {
        return true;
    } else {
        return false;
    }
}

if(session_id() == '' || !isset($_SESSION) || session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!(isset($_COOKIE['username']))) {
    if (isset($_SESSION['username'])) {
        setcookie('username', $_SESSION['username'], time() + 3600 * 24 * 7, '/'); // le cookie reste 7 jours
        setcookie('email', $_SESSION['email'], time() + 3600 * 24 * 7, '/'); // le cookie reste 7 jours
    }
} else if (!(isset($_SESSION['username']))) {
    if (isset($_COOKIE['username'])) {
        $_SESSION['username'] = $_COOKIE['username'];
        $_SESSION['email'] = $_COOKIE['email'];
    }
}

if (isset($_COOKIE['username'])) {
    if(!(checkAccountExist($_COOKIE['username'], $_COOKIE['email']))) {
        unset($_COOKIE['username']);
        unset($_COOKIE['email']);
    }
}

if (isset($_SESSION['username'])) {
    if(!(checkAccountExist($_SESSION['username'], $_SESSION['email']))) {
        session_destroy();
        unset($_SESSION['username']);
        unset($_SESSION['email']);
    }
}
?>