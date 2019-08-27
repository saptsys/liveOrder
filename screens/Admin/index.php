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
            if(! ($_SESSION['role'] == "Admin") ){
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
    <title>Home : Admin Panel</title>
    <link rel="icon" href="https://image.flaticon.com/icons/png/512/65/65155.png">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">    
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <script src="../../assets/js/script.js"></script>

    <link rel="stylesheet" href="../../assets/js/JQueryUi/jquery-ui.css">
    <link rel="stylesheet" href="../../assets/js/jquery-ui.structure.css">
    <link rel="stylesheet" href="../../assets/js/jquery-ui.theme.css">
    <script src="../../assets/js/JQueryUi/jquery-ui.js"></script>

    <link rel="stylesheet" href="../../assets/css/header.css">
    <link rel="stylesheet" href="../../assets/css/Index-style.css">
    <link rel="stylesheet" href="./assets/css/style.css">
</head>
<body>
    <?php require_once("../../component/header.php") ?>
    <div id="main-page" class="container">
       <!--  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
             <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#menu0">Menu 0</a></li>
                <li><a data-toggle="tab" href="#menu1">Menu 1</a></li>
                <li><a data-toggle="tab" href="#menu2">Menu 2</a></li>
                <li><a data-toggle="tab" href="#menu3">Menu 3</a></li>
              </ul>
        </div> -->
            <div id="menu0" class="col-xs-12 col-sm-12 col-md-12 col-lg-12 tableWrapper">
                <div class="panel panel-default">
                    <!-- Default panel contents -->
                    <div class="panel-heading heading">
                        <b>Manage Products</b>
                        <button onclick="addProducts()" style="text-align:center" type="button"  class="btn btn-primary-outline">
                            <i style="color:green" class="fa fa-lg fa-plus-circle"></i>
                        </button>
                    </div>
                    <!-- Table -->
                    <table class="table table-striped table-hover">
                        <thead class="tableheading">
                            <tr>
                                <th>#</th>
                                <th>Category</th>
                                <th>No. of Products</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="products"></tbody>
                    </table>
                </div>
            </div>

            <div id="menu1" class="col-xs-12 col-sm-12 col-md-12 col-lg-12 tableWrapper ">
                <div class="panel panel-default">
                    <!-- Default panel contents -->
                    <div style="text-align:center" class="panel-heading heading invoiceHeading">
                        <b style="width:100%">Invoices</b>
                    </div>
                    <!-- Table  -->
                    <table class="table-striped table">
                        <thead class="tableheading">
                            <tr>
                                <th>#</th>
                                <th>Table</th>
                                <th>Waiter</th>
                                <th class="tym">Time</th>
                                <th>GrossAmount</th>
                                <th>GST</th>
                                <th>TotalAmount</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="invoiceContent"></tbody>
                    </table>
                </div>
            </div>
            <div id="menu2" class="col-xs-12 col-sm-6 col-md-6 col-lg-6 tableWrapper">
                <div class="panel panel-default">
                    <!-- Default panel contents -->
                    <div class="panel-heading heading">
                        <b>Manage Users</b>
                        <button onclick="addUser()" style="text-align:center" type="button"  class="btn btn-primary-outline">
                            <i style="color:green" class="fa fa-lg fa-plus-circle"></i>
                        </button>
                    </div>
                    <!-- Table -->
                    <table class="table table-striped">
                        <thead class="tableheading">
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Role</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="userContent"></tbody>
                    </table>
                </div>
            </div>
            <div id="menu3" class="col-xs-12 col-sm-6 col-md-6 col-lg-6 tableWrapper ">
                <div class="panel panel-default">
                    <!-- Default panel contents -->
                    <div class="panel-heading heading">
                        <b>Manage Tables</b>
                        <button onclick="addTable(true)" style="text-align:center" type="button"  class="btn btn-primary-outline">
                            <i style="color:green" class="fa fa-lg fa-plus-circle"></i>
                        </button>
                    </div>
                    <!-- Table -->
                    <table class="table-striped table">
                        <thead class="tableheading">
                            <tr>
                                <th>#</th>
                                <th>Table</th>
                                <th>Capacity</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="tableContent"></tbody>
                    </table>
                </div>
            </div>
            
          <!-- Modal -->
          <div class="modal fade" id="modal" role="dialog">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title" id="modelHeader">Modal Header</h4>
                </div>
                <div class="modal-body" id="modelBody">
                  <p>ModelBody</p>
                </div>
                <div class="modal-footer" id="modelFooter">
                    <div class="input-group">
                        <button id="submitProductsBtn"  type="button"  class="btn-block btn btn-success">
                            Sumbit
                            <i class="fa fa-sm fa-check-circle"></i>
                        </button>
                        <span class="input-group-btn">
                            <button type="button" class="btn-block btn btn-danger" data-dismiss="modal">
                                Close
                            </button>
                        </span>
                    </div>
                </div>
              </div>
            </div>
          </div>
        <div id="dialog"> </div>
    </div>
    <script src="./assets/js/script.js"></script>
</body>
</html>