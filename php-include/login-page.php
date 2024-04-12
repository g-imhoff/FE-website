<head>
    <link rel="stylesheet" href="./css/login.css">
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

<body>
    <main> 
        <div class = "box">
        <?php if ($wantToCreate == 1) {?>

            <form action="" method="post" autocomplete="off">
                <label>Email</label>
                <input type="text" name="email" value="">

                <label><?php echo $trad["login"]["user"]; ?></label>
                <input type="text" name="username" value="">

                <label><?php echo $trad["login"]["pass"]; ?></label>
                <input type="text" name="password" value="">

                <label><?php echo $trad["login"]["confirm"]; ?></label>
                <input type="text" name="confirm password" value="">
            </form>
            <button type="submit" name="submit"><p><?php echo $trad["login"]["create"]; ?></p></button>

        <?php } else { ?>
            <form action="" method="post" autocomplete="off">
                <label>Email</label>
                <input type="text" name="email" value="">

                <label><?php echo $trad["login"]["pass"]; ?></label>
                <input type="text" name="password" value="">
            </form>
            <button type="submit" name="submit"><p>Log in</p></button>
        <?php } ?>
        </div>
    </main>

    <footer>
        <?php if ($wantToCreate == 1) {?>
            <form method="GET">
                <input type="hidden" name="wantToCreate" value="0">
                <button type="submit"><p><?php echo $trad["login"]["haveAccount"]; ?></p></button>
            </form>
        <?php } else { ?>
            <form method="GET">
                <input type="hidden" name="wantToCreate" value="1">
                <button type="submit"><p><?php echo $trad["login"]["createAccount"]; ?></p></button>
            </form>
        <?php } ?>
    </footer>
</body>