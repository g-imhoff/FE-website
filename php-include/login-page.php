<head>
    <link rel="stylesheet" href="/css/login.css">
</head>

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
    require_once ($_SERVER['DOCUMENT_ROOT'] . '/php-include/function/login-function.php');
?>

<?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($wantToCreate == 1) {
        $error = createUser($_POST['email'], $_POST['username'], $_POST['password'], $_POST['confirmPassword']);
    } else {
        $error = logUser($_POST['email'], $_POST['password']);
    }
}

if (isset($error)) {
    if ($error == "Success" && $wantToCreate == 1) {
        header('Location: /login.php?wantToCreate=0');
    } else if ($error == "Success" && $wantToCreate == 0) {
        header('Location: /account.php');
    }
}

?>
<body>
    <main> 
        <div class = "box">
        <?php if ($wantToCreate == 1) {?>

            <form action="" method="post" autocomplete="off">
                <label>Email</label>
                <input type="text" name="email" value="<?php echo @$_POST['email']?>" required>

                <label><?php echo $trad["login"]["user"]; ?></label>
                <input type="text" name="username" value="<?php echo @$_POST['username']?>" required>

                <label><?php echo $trad["login"]["pass"]; ?></label>
                <input type="password" name="password" value="<?php echo @$_POST['password']?>" required>

                <label><?php echo $trad["login"]["confirm"];?> <p style="color: red;"> <?php if (isset($error)) echo $error;?></p>

                </label>
                <input type="password" name="confirmPassword" value="<?php echo @$_POST['confirmPassword']?>" required>
                <button type="submit" name="submit"><p><?php echo $trad["login"]["create"]; ?></p></button>
            </form>
        <?php } else { ?>
            <form action="" method="post" autocomplete="off">
                <label><?php echo $trad["login"]["email"]; ?></label>
                <input type="text" name="email" value="<?php echo @$_POST['email']?>" required>

                <label><?php echo $trad["login"]["pass"]; ?><p style="color: red;"><?php if (isset($error) && $error !== "Success") echo $error;?></p></label>
                <input type="password" name="password" value="<?php echo @$_POST['password']?>" required>
                <button type="submit" name="submit"><p><?php echo $trad["login"]["log"]; ?></p></button>
            </form>
        <?php } ?>
        </div>
    </main>

    <footer>
        <?php if ($wantToCreate == 1) {?>
            <form method="GET">
                <input type="hidden" name="wantToCreate" value="0">
                <button type="submit"><p><?php echo $trad["login"]["haveAccount"];?></p></button>
            </form>
        <?php } else { ?>
            <form method="GET">
                <input type="hidden" name="wantToCreate" value="1">
                <button type="submit"><p><?php echo $trad["login"]["createAccount"];?></p></button>
            </form>
        <?php } ?>
    </footer>
</body>