<?php
    require_once '../db/db-connect.php';
    require_once '../lang/get-lang.php';
    require_once '../db/loadmore.php';
    require_once '../db/users.php';
?>


<?php 
    $l = new LoadMore();
    $l->getLoadMore($_GET['number']); 
?>