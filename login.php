<?php
    require_once './lang/get-lang.php';
    include_once './db/db-connect.php';
?> 

<?php
$wantToCreate = 0;
if(isset($_GET['wantToCreate'])) {
    $wantToCreate = $_GET['wantToCreate'];

    setcookie('wantToCreate', $wantToCreate, time() + 3600 * 24 * 7, '/'); // le cookie reste 7 jours
} else {
    if (isset($_COOKIE['wantToCreate'])) {
        $wantToCreate = $_COOKIE['wantToCreate'];
    }
}
?> 

<?php 
$db = new Database();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($wantToCreate == 1) {
        $error = $db->createUser($_POST['email'], $_POST['username'], $_POST['password'], $_POST['confirmPassword']);
    } else {
        $error = $db->logUser($_POST['email'], $_POST['password']);
    }
}

if (isset($_SESSION["username"]) || isset($_COOKIE["username"])) {
    header("Location: /account.php");
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Lesson</title>

        <!-- CSS -->        
        <link rel="stylesheet" href="/css/base.css">
        <link rel="stylesheet" href="/css/font.css">

        <!-- Favicon -->
        <link rel="shortcut icon" href="/assets/ico/favicon.ico" type="image/x-icon">

        <script defer src="/js/formBaseFunction.js"></script>
        <script defer src="/js/formLoginValidation.js"></script>
    </head>
    <body>
        <?php
            include_once "./template/header.php";
        ?>

        <?php
            include_once './main/login-main.php';
        ?>

        <?php
            include_once "./footer/login-footer.php";
        ?>

        <?php
            echo $_SESSION['test'];
        ?>
        
    </body>
</html>