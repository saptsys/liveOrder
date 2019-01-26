<?php
    session_start();

    if( (isset($_SESSION["user"])) && (isset($_SESSION["pass"])) && (isset($_COOKIE["user"])) && (isset($_COOKIE["pass"])) ){
        echo $_SESSION["user"]." is an ".$_SESSION["role"];
    }else{
        header('Location: ../../index.php');
    }
?>