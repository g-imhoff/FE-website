<body>
    <footer>
        <?php if ($wantToCreate == 1) {?>
            <form method="GET">
                <input type="hidden" name="wantToCreate" value="0">
                <button type="submit"><p><?php echo $trad["login"]["haveAccount"];?></p></button>
            </form>
        <?php } else { ?>
            <form method="GET">
                <input type="hidden" name="wantToCreate" value="1">
                <button type="submit"><p><?php echo $trad["login"]["createAccount"];?></p></button>
            </form>
        <?php } ?>
    </footer>
</body>