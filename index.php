<?php
        $ok=false;
        if( (isset($_COOKIE['user'])) && ( isset($_COOKIE['pass']) ) ){
            $user=$_COOKIE['user'];
            $pass=$_COOKIE['pass'];
            require_once "userAuth.php";
            $auth=new authenticate($user,$pass,false,true);
            if($auth->authenticated) $ok=true;
        }
        if(!$ok) header('Location: screens/Menu');
?>