<header> 

    <a href="./index.php"><img src="./assets/img/logo.png" alt="logo" class="logo"></a>
    
    <nav>
        <ul>
            <li><a href="./lesson.php"><p>Lesson</p></a></li>
            <li><a href="./about.php"><p>About</p></a></li>
            <li><a href="./contact.php"><p>Contact</p></a></li>
        </ul>
    </nav>

    <a href="./login.php" class="login-animation"><p>Login</p></a>


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
            <li><a href="./login.php"><p>Login</p></a></li>
        </ul>
    </div>
    
</header>
