<?php
    session_start();
    setcookie('user','logout',time()-1,'/');
    setcookie('pass','logout',time()-1,'/');
    session_destroy();
    header('location: ../');
?>