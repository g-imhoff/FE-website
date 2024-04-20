<?php
    require_once './lang/get-lang.php';
    require_once './db/db-connect.php';
    require_once('./db/users.php');
?> 

<?php
$wantToCreate = 0;
if(isset($_GET['wantToCreate'])) {
    $wantToCreate = $_GET['wantToCreate'];

    setcookie('wantToCreate', $wantToCreate, time() + 3600 * 24, '/');
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
$users = new Users();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($wantToCreate == 1) {
        $error = $users->createUser($_POST['email'], $_POST['username'], $_POST['password'], $_POST['confirmPassword']);
        setcookie('error-create-account', $error, [
            'expires' => time() + 3, 
            'path' => '/', 
            'samesite' => 'Strict'
        ]);

        if ($error !== "Success") {
            setcookie('email-error-create', $_POST['email'], [
                'expires' => time() + 3, 
                'path' => '/', 
                'samesite' => 'Strict' 
            ]);

            setcookie('username-error-create', $_POST['username'], [
                'expires' => time() + 3, 
                'path' => '/', 
                'samesite' => 'Strict' 
            ]);
        }
    } else {
        $error = $users->logUser($_POST['email'], $_POST['password']);
        setcookie('error-login-account', $error, [
            'expires' => time() + 3, 
            'path' => '/', 
            'samesite' => 'Strict' 
        ]);

        if ($error !== "Success") {
            setcookie('email-error-login', $_POST['email'], [
                'expires' => time() + 3, 
                'path' => '/', 
                'samesite' => 'Strict' 
            ]);
        }
    }
}

?>

<!DOCTYPE html>
<html lang="<?php echo $lang;?>">
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