<?php
    require_once('../lang/get-lang.php');
    require_once('../db/db-connect.php');
    require_once('../db/users.php');
?>

<?php 
    $db = new Database();
    if ($db->verifyAdmin($_COOKIE['username']) != 1) {
        header("Location: /index.php");
    }
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
        <link rel="stylesheet" href="/css/main-admin.css">

        <!-- Favicon -->
        <link rel="shortcut icon" href="/assets/ico/favicon.ico" type="image/x-icon">
        
        <!-- Js -->
        <script src="./js/showTools.js"></script>
    </head>

    <?php
        include_once('../template/header.php');
    ?>

    <main>
        <?php 
            require_once('./all-tools.php');

            foreach($tools as $tool) {
                echo '<button onclick="showClass(\''. $tool["class"] . '\')">' . '<p>' . $tool["name"] . '</p>' . '</button>';
                foreach ($tool["require"] as $require) {
                    require_once($require);
                }
                include_once($tool["file"]);
            }

        ?>
    </main>
</html>