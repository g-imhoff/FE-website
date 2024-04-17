<head>
    <link rel="stylesheet" href="/css/login.css">
</head>

<body>
    <main> 
        <div class = "box">
            <form action="" method="post" autocomplete="off" id="form-login">
                <?php if ($wantToCreate == 1) {?>
                    <label>Email</label>
                    <input id ="email" type="text" name="email" value="<?php
                        if (isset($_COOKIE['email-error-create'])) {
                            echo $_COOKIE['email-error-create'];
                        }
                    ?>" >

                    <label><?php echo $trad["login"]["user"]; ?></label>
                    <input id ="username" type="text" name="username" value="<?php
                        if (isset($_COOKIE['username-error-create'])) {
                            echo $_COOKIE['username-error-create'];
                        }
                    ?>" >

                    <label><?php echo $trad["login"]["pass"]; ?></label>
                    <input id="password" type="password" name="password" value="" >

                    <label><?php echo $trad["login"]["confirm"];?> <p style="color: red;"> 
                        <?php 
                            if (isset($_COOKIE['error-create-account'])) { 
                                if ($_COOKIE['error-create-account'] !== "Success") { 
                                    echo $_COOKIE['error-create-account'];
                                }
                            }
                        ?>
                    </p>

                    </label>
                    <input id ="confirm-password" type="password" name="confirmPassword" value="" >
                    <button type="submit" name="submit"><p><?php echo $trad["login"]["create"]; ?></p></button>
                <?php } else { ?>
                    <label><?php echo $trad["login"]["email"]; ?></label>
                    <input id="email" type="text" name="email" value="<?php
                        if (isset($_COOKIE['email-error-login'])) {
                            echo $_COOKIE['email-error-login'];
                        }
                    ?>" >

                    <label><?php echo $trad["login"]["pass"]; ?><p style="color: red;">
                    <?php 
                        if (isset($_COOKIE['error-login-account'])) { 
                            if ($_COOKIE['error-login-account'] !== "Success") { 
                                echo $_COOKIE['error-login-account'];
                            }
                        }
                    ?>
                    </p></label>
                    <input id ="password" type="password" name="password" value="" >
                    <button type="submit" name="submit"><p><?php echo $trad["login"]["log"]; ?></p></button>
                <?php } ?>
            </form>
        </div>
    </main>

    <p>

    <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            echo 'a';
        }
    ?>
    </p>
</body>