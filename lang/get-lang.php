<?php
    $lang = 'fr'; 

    if (isset($_GET['lang'])) {
        $lang = $_GET['lang'];
    }

    if ($lang == 'fr') {
        include_once 'fr.php';
    } else if ($lang == 'en') {
        include_once 'en.php';
    }
?>