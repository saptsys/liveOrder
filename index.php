<?php
    $ok=false;
    if( (isset($_COOKIE['user'])) && ( isset($_COOKIE['pass']) ) ){
        $user=$_COOKIE['user'];
        $pass=$_COOKIE['pass'];
        require_once "auth.php";
        $auth=new authenticate($user,$pass,false);
        if($auth->authenticated) $ok=true;
    }
    if(!$ok) header('Location: login.php');
?>
