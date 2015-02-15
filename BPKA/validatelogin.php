<?php
    if(!isset($_SESSION['CurrentUserId'])){
        header('location:index.php');
    }
?>