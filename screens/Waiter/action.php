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
        if($flag=="itemSelected")
            itemsSelected($con,$_POST['selectedItems'],$_POST['tableId']);
        if($flag=="getOrderedList")
            getOrderedList($con,$_POST['tableId']);

    
    
    
    
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
            <div id='dining-table$row[0]' class='dining-table  $class col-lg-2 col-md-2 col-sm-2 col-xs-3'>
                <div onclick='setTableId($row[0])'>
                    <h3>$row[1]</h3>
                </div>
            </div><!-- .dining-table -->";
        }
        echo "
        <div class='totalItemLabel backArrow dining-table $class col-lg-2 col-md-2 col-sm-2 col-xs-3'>
                <P>Total Items <br><b>0</b></P>
            </div>
        <div onclick='informToCoock()' class=' forwardArrow col-lg-1 col-md-1 col-sm-1 col-xs-2'>
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
                                <i class='fa fa-minus' onclick='subtractQ($row_products[Id])'></i>
                                <b id='Q$row_products[Id]' class='counter'>0</b>
                                <i class='fa fa-plus' onclick='addQ($row_products[Id])'></i>
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

    function itemsSelected($con,$items,$tableId)
    {
        mysqli_query($con,"UPDATE `tables` SET `IsOccupied`=1 WHERE `Id`=$tableId") or die("error to set is occupied = 1");
        foreach ($items as $productId => $productQuantity) {
            $data = mysqli_query($con,"SELECT `Id` FROM `kitchen` WHERE `ProductId`=$productId AND `TableId`=$tableId LIMIT 1");
            if(mysqli_num_rows($data)>0)
            {   
                $row = mysqli_fetch_array($data);
                mysqli_query($con,"UPDATE `kitchen` SET Pending=Pending+$productQuantity WHERE `Id`=$row[0] AND `ProductId`=$productId AND `TableId`=$tableId") or die("error to increase available pending items");
            }
            else
            {
                mysqli_query($con,"INSERT INTO `kitchen`(`Id`, `TableId`, `ProductId`, `Pending`) VALUES (null,$tableId,$productId,$productQuantity)") or die("error to insert data in kitchen");
            }
        }
        print_r($items);
        echo $tableId;
    }

    function getOrderedList($con,$tableId)
    {
        $data = mysqli_query($con,"SELECT c.Name `categories`, p.Name `products`, k.Pending `kitchen`, k.Quantity `kitchen`
                                    FROM `categories` c, `products` p, `kitchen` k
                                    WHERE k.TableId = $tableId AND k.ProductId = p.Id AND p.CatId=c.Id");
        echo " <table class='table table-striped' > 
        <thead class='thead-light'>
            <tr>
                <th>Item Name</th>
                <th>Ordered</th>
                <th>Served</th>
            </tr>
        </thead>
        <tbody>
        ";
        while($row = mysqli_fetch_array($data))
        {
            echo "
                <tr>
                    <td>$row[0] $row[1]</td>
                    <td> $row[2]</td>
                    <td> $row[3]</td>
                </tr>
            ";
        }
        echo "</tbody>
        </table>";
    }
?>