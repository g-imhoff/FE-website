<head>
    <link rel="stylesheet" href="/css/login.css">
</head>

<body>
    <main> 
        <div class = "box">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" autocomplete="off" id="form-login">
                <?php if ($wantToCreate == 1) {?>
                    <label for="email">Email</label>
                    <input id ="email" type="text" name="email" value="<?php
                        if (isset($_COOKIE['email-error-create'])) {
                            echo $_COOKIE['email-error-create'];
                        }
                    ?>" >

                    <label for="username"><?php echo $trad["login"]["user"]; ?></label>
                    <input id ="username" type="text" name="username" value="<?php
                        if (isset($_COOKIE['username-error-create'])) {
                            echo $_COOKIE['username-error-create'];
                        }
                    ?>" >

                    <label for="password"><?php echo $trad["login"]["pass"]; ?></label>
                    <input id="password" type="password" name="password" value="" >

                    <label for="confirm-password"><?php echo $trad["login"]["confirm"];?> </label>
                    <input id ="confirm-password" type="password" name="confirm-password" value="" >
                    <p style="color: var(--red);"> 
                            <?php 
                                if (isset($_COOKIE['error-create-account'])) { 
                                    if ($_COOKIE['error-create-account'] !== "Success") { 
                                        echo $_COOKIE['error-create-account'];
                                    }
                                }
                            ?>
                    </p>
                    <button type="submit" name="submit"><?php echo $trad["login"]["create"]; ?></button>
                <?php } else { ?>
                    <label for="email"><?php echo $trad["login"]["email"]; ?></label>
                    <input id="email" type="text" name="email" value="<?php
                        if (isset($_COOKIE['email-error-login'])) {
                            echo $_COOKIE['email-error-login'];
                        }
                    ?>" >

                    <label for="password"><?php echo $trad["login"]["pass"]; ?></label>
                    <input id ="password" type="password" name="password" value="" >
                    <p style="color: red;">
                    <?php 
                        if (isset($_COOKIE['error-login-account'])) { 
                            if ($_COOKIE['error-login-account'] !== "Success") { 
                                echo $_COOKIE['error-login-account'];
                            }
                        }
                    ?>
                    </p>
                    <button type="submit" name="submit"><?php echo $trad["login"]["log"]; ?></button>
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