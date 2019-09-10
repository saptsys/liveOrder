<?php
    //Checking database exist or not    
    include "config.php";
    $mycon = new config();
    $conn = $mycon->dbOnlyCon();
    
    $result = mysqli_query($conn,"SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '$mycon->db'")or die("Dead at index page..");
    $row = mysqli_num_rows($result);
    if($row != 1)
    {?>
        <center>
            <br><br><br><br><br>
            <br>
            Please Wait, Loading Database...
        </center>
    <?php
        echo "<script>window.location='Database/initialize.php';</script>";
    }
    else
    {
        $ok=false;
        if( (isset($_COOKIE['user'])) && ( isset($_COOKIE['pass']) ) ){
            $user=$_COOKIE['user'];
            $pass=$_COOKIE['pass'];
            require_once "userAuth.php";
            $auth=new authenticate($user,$pass,false,true);
            if($auth->authenticated) $ok=true;
        }
        if(!$ok) header('Location: screens/Menu');
    }
?>