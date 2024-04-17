<?php

    $db = new Database();

    if (!isset($_COOKIE["username"]) || !isset($_COOKIE["username"])) {
        header("Location: /login.php");
    }

?>

<head>
    <link rel="stylesheet" href="/css/main-account.css">

    <script src="/js/logFunction.js"></script>
</head>

<body>
    <main>
        <article class="first-grid">
            <h1><?php echo $trad["account"]["profil"] ?></h1>

            <p><?php echo $_COOKIE["username"]; ?></p>
            <p><?php echo $_COOKIE["email"]; ?></p>

            <?php if ($db->verifyAdmin($_COOKIE["username"]) == 1) { ?>
                <a href="/admin/admin.php"> ADMIN PAGE </a>
            <?php } ?>
        </article>

        <article class="second-grid">
                <button onclick="logout()">Logout</button>
        </article>
    </main>
</body>