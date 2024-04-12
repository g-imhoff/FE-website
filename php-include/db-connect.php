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

?>