<?php

    $db = new Database();

    if (!isset($_SESSION["username"]) || !isset($_COOKIE["username"])) {
        header("Location: /login.php");
    }

?>

<head>
    <link rel="stylesheet" href="/css/main-account.css">
</head>

<body>
    <main>
        <article class="first-grid">
            <h1><?php echo $trad["account"]["profil"] ?></h1>

            <p><?php echo $_SESSION["username"]; ?></p>
            <p><?php echo $_SESSION["email"]; ?></p>

            <?php if ($db->verifyAdmin($_SESSION["username"]) == 1) { ?>
                <a href="/admin/admin.php"> ADMIN PAGE </a>
            <?php } ?>
        </article>

        <article class="second-grid">
            <section class="second-first-grid">
                <h1><?php echo $trad["account"]["comments"]?></h1>
            </section>

            <section class="second-second-grid">
                <h1><?php echo $trad["account"]["notes"]?></h1>
            </section>
        </article>

        <article class="third-grid">
            <h1><?php echo $trad["account"]["favorite"]?></h1>
        </article>
    </main>
</body>