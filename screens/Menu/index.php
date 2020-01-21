<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Menu</title>
    <link rel="icon" href="https://image.flaticon.com/icons/png/512/65/65155.png">
    <link rel="stylesheet" href="../../assets/css/header.css">
    <!-- <script src="../../assets/js/script.js"></script> -->
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
        <center><br/><h3><i class='fas fa-cocktail'></i> Menu</h3></center>
        <br/>
        <div class="row search-box-row">
            <div class="col-lg-offset-1 col-lg-10 col-md-offset-1 col-md-10 col-sm-offset-1 col-sm-10 col-xs-offset-1 col-xs-10">
                <!-- <select class="mdb-select md-form filter-box">
                    <option value="" disabled selected>Filter</option>
                    <option value="1">All</option>
                    <option value="2">Category</option>
                    <option value="3">Recipes</option>
                </select> -->
                <input class="search-box" id="searchBox" type="text" tabindex=0 placeholder="Search Recipes / Category" aria-label="Search">
            </div>
        </div>
        <hr/>
        <div class="row result-row">

        </div>
    </div>
    <script src="./assets/js/script.js"></script>
</body>
</html>