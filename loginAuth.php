<?php
    if ($_SERVER["REQUEST_METHOD"] != "POST") exit();
    
    $allok=false;
    if ( (isset($_POST['username'])) && (isset($_POST["password"])) ) {
       if( ($_POST['username'] != "") && ($_POST['password'] != "") ){
            $allok=true;
       }else $allok=false;
    }else $allok = false;
    
    if($allok) {
        require_once "auth.php";
        $auth=new authenticate($_POST["username"],$_POST["password"],true,true);
    }else{
        header('Location: login.php');
    }
?>