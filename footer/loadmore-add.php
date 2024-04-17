<?php
    require_once '../db/db-connect.php';
    require_once '../lang/get-lang.php';
    require_once '../footer/loadmore-function.php';
?>


<?php 
    loadMore($_GET['number']); 
?>