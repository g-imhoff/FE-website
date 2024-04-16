<?php
    require_once './lang/get-lang.php';
    include_once './db/db-connect.php';
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>FE</title>

        <!-- CSS -->        
        <link rel="stylesheet" href="/css/base.css">
        <link rel="stylesheet" href="/css/font.css">

        <!-- Favicon -->
        <link rel="shortcut icon" href="/assets/ico/favicon.ico" type="image/x-icon">
    </head>

    <body>
        <?php
            $db = new Database();
            $conn = $db->pdo;

            var_dump($conn);
        ?>
    </body>
    <?php
        include_once "./php-include/template/header.php";
    ?>

    <?php
        include_once './php-include/index-page.php'
    ?>

</html>