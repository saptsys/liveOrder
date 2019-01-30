<?php
    session_start();
    if( ( (isset($_COOKIE['user'])) && (isset($_COOKIE['pass'])) ) ){
        if( !( isset($_SESSION['user']) && isset($_SESSION['pass']) && isset($_SESSION['role']) ) ){
            require_once '../../auth.php';
            $auth = new authenticate($_COOKIE['user'],$_COOKIE['pass'],false,true);
            if(!$auth->authenticated) header('Location: ../../');
            else{
                header('Location: ../../');
                exit();
            }
        }else{
            if(! ($_SESSION['role'] == "Chef") ){
                header('Location: ../../');
            }
        }
    }else{
        header('Location: ../../');
        exit();
    }
    include "../../config.php";
    $mycon = new config();
    $con = $mycon->db();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LogIn</title>
    <link rel="stylesheet" href="../../assets/css/header.css">
    <script src="../../assets/js/script.js"></script>
    <link rel="stylesheet" href="./assets/css/style.css">

    <link rel="stylesheet" href="../../assets/css/Index-style.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">   
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

</head>
<body> 
    <!-- header file -->
    <?php require_once("../../component/header.php") ?>

  
    <div id="main-page" class="container">
        <div id="loader">
            <img src="../../assets/images/loader.gif" width=100px alt="Loading..">
        </div>
        <div class="wrapper">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Dish</th>
                        <th>Quantity</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="content"> </tbody>
            </table>
        </div>
    </div> <!-- #main-page .container .row -->
    <script src="./assets/js/script.js"></script>
</body>
</html>