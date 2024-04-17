<?php
    require_once './lang/get-lang.php';
    require_once './db/db-connect.php';
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

if (isset($_COOKIE['error-create-account'])) {
    if($_COOKIE['error-create-account'] === 'Success') {
        header('Location: /login.php?wantToCreate=0');
    }
}

if (isset($_COOKIE['error-login-account'])) {
    if($_COOKIE['error-login-account'] === 'Success') {
        header('Location: /account.php');
    }
}
?> 

<?php 
$db = new Database();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($wantToCreate == 1) {
        $error = $db->createUser($_POST['email'], $_POST['username'], $_POST['password'], $_POST['confirmPassword']);
        setcookie('error-create-account', $error, time() + 3, '/');

        if ($error !== "Success") {
            setcookie('email-error-create', $_POST['email'], time() + 3, '/');
            setcookie('username-error-create', $_POST['username'], time() + 3, '/');
        }
    } else {
        $error = $db->logUser($_POST['email'], $_POST['password']);
        setcookie('error-login-account', $error, time() + 3, '/');

        if ($error !== "Success") {
            setcookie('email-error-login', $_POST['email'], time() + 3, '/');
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login</title>

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
    </body>
</html>