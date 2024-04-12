<head>
    <!-- CSS -->        
    <link rel="stylesheet" href="./css/header.css">

    <!-- Js -->
    <script src="./js/burgerMenu.js"></script>

</head>

<body>
    <!-- Header -->

    <header> 
        <!-- Logo -->
        <a href="./index.php"><img src="./assets/img/logo.png" alt="logo" class="logo"></a>

        <!-- Navigation -->
        <nav>
            <ul>
                <li><a href="./all-lesson.php"><p><?php echo $trad['Header']['Lesson']?></p></a></li>
                <li><a href="./login.php"><p><?php echo $trad['Header']['Login']?></p></a></li>
                <?php if (isset($_SESSION['user'])) { ?>
                    <li><a href="./php-include/account.php"><p><?php echo $trad['Header']['Logout']?></p></a></li>
                <?php } ?>
            </ul>
        </nav>

        <!-- Change language -->
        <form class="form-animation form-english form-display">
            <?php
                foreach ($_GET as $key => $value) {
                    if ($key !== 'lang') {
                        echo '<input type="hidden" name="' . htmlspecialchars($key) . '" value="' . htmlspecialchars($value) . '">';
                    }
                }
            ?>

            <input type="hidden" name="lang" value="<?php 
                if($lang == 'fr') {
                    echo 'en';
                } else {
                    echo 'fr';
                }
            ?>">
            <button type="submit"> <p><?php echo htmlspecialchars($trad['Header']['Change'])?></p> </button>
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
                    <img src="../assets/img/close.png" alt="close button">
                </div>
            </div>

            <ul>
                <li><a href="./lesson.php"><p><?php echo $trad['Header']['Lesson']?></p></a></li>
                <li><a href="./login.php"><p><?php echo $trad['Header']['Login']?></p></a></li>

                <li>
                    <form class="form-english" method="GET">
                        <?php
                            foreach ($_GET as $key => $value) {
                                if ($key !== 'lang') {
                                    echo '<input type="hidden" name="' . htmlspecialchars($key) . '" value="' . htmlspecialchars($value) . '">';
                                }
                            }
                        ?>
                        <input type="hidden" name="lang" value="<?php 
                            if($lang == 'fr') {
                                echo 'en';
                            } else {
                                echo 'fr';
                            }
                        ?>">
                        <button type="submit"> <p><?php echo htmlspecialchars($trad['Header']['Change'])?></p> </button>
                    </form>
                </li>

            </ul>
        </div>

    </header>
</body>
