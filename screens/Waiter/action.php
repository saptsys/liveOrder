<?php
    include "../../config.php";
    $mycon = new config();
    $con = $mycon->db();
    
    $flag="";
    if(isset($_POST['flag']))
        $flag = $_POST['flag'];
    else
        echo "<script>window.location='index.php';</script>";
    
        if($flag=="getTable")
        getTable($con);    
        if($flag=="getMenu")
            getMenu($con);

    
    
    
    
    function getTable($con)
    {  
        echo "
        <div class=' backArrow col-lg-offset-3 col-lg-1 col-md-offset-3 col-md-1 col-sm-offset-3 col-sm-1 col-xs-offset-1 col-xs-2'>
                <center><i title='BACK TO HOME' class='fas fa-arrow-alt-circle-left arrows'></i></center>
            </div>
        ";
        $data = mysqli_query($con,"SELECT * FROM `tables`");
        while($row = mysqli_fetch_array($data))
        { 
            if($row[3]==1)
                $class="Occupied";
            else
                $class="";
            echo"
            <div class='dining-table  $class col-lg-2 col-md-2 col-sm-2 col-xs-3'>
                <div>
                    <h3>$row[1]</h3>
                </div>
            </div><!-- .dining-table -->";
        }
        echo "
        <div class='totalItemLabel backArrow dining-table $class col-lg-2 col-md-2 col-sm-2 col-xs-3'>
                <div style='background:rgba(0,0,0,0.1);'>
                    <b>ITEMS <br> 6 </b>
                </div>
            </div>
        <div class=' forwardArrow col-lg-1 col-md-1 col-sm-1 col-xs-2'>
            <center><i title='INFORM TO COOCK' class='fas fa-arrow-alt-circle-right arrows'></i></center>
        </div>";
    }

    function getMenu($con)
    {
        echo "<center><h3><i class='fas fa-cocktail'></i> MENU</h3></center> <br>";
        $data_categories = mysqli_query($con,"SELECT * from `categories` ORDER BY `Name`");
        while($row_categories = mysqli_fetch_array($data_categories))
        {
            echo "
            <div class='col-lg-3 col-md-3 col-sm-4 col-xs-6'>
                <div class='catBox'>
                    <div class='catName'>$row_categories[Name] <span><i class='fas fa-sort-down'></i></span>  </div class='catName'>
                    <ul>";
                        $data_products = mysqli_query($con,"SELECT * from `products` WHERE `CatId`=$row_categories[0] ORDER BY `Name`");
                        while($row_products = mysqli_fetch_array($data_products))
                        {
                            echo "<li>$row_products[Name]
                            <span>
                                <i class='fa fa-minus'></i>
                                <b>0</b>
                                <i class='fa fa-plus'></i>
                            </span>
                            </li>";
                        }
                    echo"
                    </ul>
                </div>
            </div>";
        }
        echo "</div> ";
    }
?>