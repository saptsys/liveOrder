<?php
    include "../../config.php";
    $mycon = new config();
    $con = $mycon->db();
    $flag="";
    if(isset($_POST['flag'])) $flag = $_POST['flag'];
    else echo "<script>window.location='index.php';</script>";
    
    if($flag=="getOrders") getOrders($con);

    function getOrders($con)  {  
        $data = mysqli_query($con,"SELECT * FROM `livetableorders` WHERE NOT(Pending = 0) ORDER BY time");
        while($row = mysqli_fetch_array($data)) { 
            $dish="";
            $productSQL=mysqli_query($con,"SELECT * FROM `products` WHERE Id = '$row[productId]' ");
            $pData=mysqli_fetch_array($productSQL);
            $dish=$pData['Name'];

            if($pData['haveCat']==1){
                print_r($pData);
                $catSQL=mysqli_query($con,"SELECT * FROM `categories` WHERE Id='$row[catId]' and productId='$pData[Id]'");
                $cData=mysqli_fetch_array($catSQL);
                $dish=$pData['Name']."/".$cData['Name'];
            }
            echo'
                <tr>
                    <td>'.$dish.'</td>
                    <td>'.$row["Quantity"].'</td>
                    <td> <button type="button" class="btn btn-success" onclick="orderReady('.$row['Id'].')">Ready!</button>
                    </td>
                </tr>
            ';
        }
    }
?>
