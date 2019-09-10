<?php
    session_start();
    setcookie('user','logout',time()-1,'/');
    setcookie('pass','logout',time()-1,'/');
    session_destroy();

    if(isset($_GET['flag']))
    {
        $flag = $_GET['flag'];
        echo $flag;
        if($flag == "dbini") header('location: ../Database/initialize.php');
    }
    else
        header('location: ../');
?>