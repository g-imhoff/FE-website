<head>
    <!-- CSS -->        
    <link rel="stylesheet" href="/css/header.css">

    <!-- Js -->
    <script src="/js/burgerMenu.js"></script>
</head>

<body>
    <!-- Header -->

    <header> 
        <!-- Logo -->
        <a href="/index.php"><img src="/assets/img/logo.png" alt="logo" class="logo"></a>

        <!-- Navigation -->
        <nav>
            <ul>
                <li><a href="/all-lesson.php"><p><?php echo $trad['Header']['Lesson'];?></p></a></li>

                <?php if (isset($_COOKIE['username'])) { ?>
                    <li><a href="/account.php"><p><?php echo $trad['Header']['Account'];?></p></a></li>
                <?php } else { ?>
                    <li><a href="/login.php"><p><?php echo $trad['Header']['Login'];?></p></a></li>
                <?php } ?>
            </ul>
        </nav>

        <!-- Change language -->
        <form class="form-animation form-english form-display">
            <?php
                foreach ($_GET as $key => $value) {
                    if ($key !== 'lang') {
                        echo '<label style="display: none;" for="' . htmlspecialchars($key) . '">' . htmlspecialchars($value) . '</label>';
                        echo '<input type="hidden" name="' . htmlspecialchars($key) . '" value="' . htmlspecialchars($value) . '">';
                    }
                }
            ?>

            <label for="lang" style="display: none;"><?php echo $trad['Header']['Change'];?></label>
            <input type="hidden" name="lang" value="<?php 
                if($lang == 'fr') {
                    echo 'en';
                } else {
                    echo 'fr';
                }
            ?>">
            <button type="submit"><?php echo $trad['Header']['Change'];?></button>
        </form>

        <!-- Burger Menu -->
        <div id="burger-menu"> 
            <div id="burger" onclick=showSidebar()> 
                    <span></span>
                    <span></span>
                    <span></span>
            </div>
        </div>

        <!-- Sidebar -->
        <div id="sidebar"> 
            <div id = "new-header"> 
                <div id="close-menu" onclick=closeSidebar()> 
                    <img src="/assets/img/close.png" alt="close button">
                </div>
            </div>

            <ul>
                <li><a href="/lesson.php"><p><?php echo $trad['Header']['Lesson'];?></p></a></li>
                
                <?php if (isset($_COOKIE['username'])) { ?>
                    <li><a href="/account.php"><p><?php echo $trad['Header']['Account'];?></p></a></li>
                <?php } else { ?>
                    <li><a href="/login.php"><p><?php echo $trad['Header']['Login'];?></p></a></li>
                <?php } ?>

                <li>
                    <form class="form-animation form-english form-display">
                        <?php
                            foreach ($_GET as $key => $value) {
                                if ($key !== 'lang') {
                                    echo '<label style="display: none;" for="' . htmlspecialchars($key) . '">' . htmlspecialchars($value) . '</label>';
                                    echo '<input type="hidden" name="' . htmlspecialchars($key) . '" value="' . htmlspecialchars($value) . '">';
                                }
                            }
                        ?>

                        <label for="lang" style="display: none;"><?php echo $trad['Header']['Change'];?></label>
                        <input type="hidden" name="lang" value="<?php 
                            if($lang == 'fr') {
                                echo 'en';
                            } else {
                                echo 'fr';
                            }
                        ?>">
                        <button type="submit"><?php echo $trad['Header']['Change'];?></button>
                    </form>
                </li>

            </ul>
        </div>

    </header>
</body>
