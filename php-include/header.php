<!-- Necessary for the header to work -->
<head>
    <!-- Css -->
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
                <li><a href="./lesson.php"><p>Lesson</p></a></li>
                <li><a href="./about.php"><p>About</p></a></li>
                <li><a href="./contact.php"><p>Contact</p></a></li>

            </ul>
        </nav>

        <!-- Login -->
        <form class="form-animation form-english form-display">
            <input type="hidden" name="lang" value="en">
            <button type="submit"> <p>Change to english</p> </button>
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
                <li><a href="./lesson.php"><p>Lesson</p></a></li>
                <li><a href="./about.php"><p>About</p></a></li>
                <li><a href="./contact.php"><p>Contact</p></a></li>
                <li>
                    <form class = "form-english">
                        <input type="hidden" name="lang" value="en">
                        <button type="submit"> <p>Change to english</p> </button>
                    </form>
                </li>
            </ul>
        </div>

    </header>
</body>
