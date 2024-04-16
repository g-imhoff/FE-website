<head>
    <link rel="stylesheet" href="/css/login.css">
</head>


<body>
    <main> 
        <div class = "box">
            <form action="" method="post" autocomplete="off" id="form-login">
                <?php if ($wantToCreate == 1) {?>
                    <label>Email</label>
                    <input id ="email" type="text" name="email" value="<?php echo @$_POST['email']?>" >

                    <label><?php echo $trad["login"]["user"]; ?></label>
                    <input id ="username" type="text" name="username" value="<?php echo @$_POST['username']?>" >

                    <label><?php echo $trad["login"]["pass"]; ?></label>
                    <input id="password" type="password" name="password" value="<?php echo @$_POST['password']?>" >

                    <label><?php echo $trad["login"]["confirm"];?> <p style="color: red;"> <?php if (isset($error)) echo $error;?></p>

                    </label>
                    <input id ="confirm-password" type="password" name="confirmPassword" value="<?php echo @$_POST['confirmPassword']?>" >
                    <button type="submit" name="submit"><p><?php echo $trad["login"]["create"]; ?></p></button>
                <?php } else { ?>
                    <label><?php echo $trad["login"]["email"]; ?></label>
                    <input id="email" type="text" name="email" value="<?php echo @$_POST['email']?>" >

                    <label><?php echo $trad["login"]["pass"]; ?><p style="color: red;"><?php if (isset($error) && $error !== "Success") echo $error;?></p></label>
                    <input id ="password" type="password" name="password" value="<?php echo @$_POST['password']?>" >
                    <button type="submit" name="submit"><p><?php echo $trad["login"]["log"]; ?></p></button>
                <?php } ?>
            </form>
        </div>
    </main>
</body>