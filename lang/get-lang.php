<?php
    $lang = 'fr'; 

    if(isset($_GET['lang'])) {
        $lang = $_GET['lang'];

        setcookie('lang', $lang, time() + 3600 * 24 * 7, '/'); // le cookie reste 7 jours
    } else {
        if (isset($_COOKIE['lang'])) {
            $lang = $_COOKIE['lang'];
        }
    }

    if ($lang == 'fr') {
        include_once 'fr.php';
    } else if ($lang == 'en') {
        include_once 'en.php';
    }
?>