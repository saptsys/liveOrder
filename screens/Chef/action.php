<?php
    include "../../config.php";
    $mycon = new config();
    $con = $mycon->db();
    $flag="";
    $id="";
    if(isset($_POST['flag'])) $flag = $_POST['flag'];
    else echo "<script>window.location='index.php';</script>";
    
    if($flag=="getOrders") getOrders($con);
    if($flag=="orderReady"){
        $id=$_POST['id'];
        orderReady($con,$id);
    } 
    if($flag=="orderDeclined"){
        $id=$_POST['id'];
        orderDeclined($con,$id);
    }

    function getOrders($con)  {  
        $data = mysqli_query($con,"SELECT * FROM `livetableorders` WHERE NOT(Pending = 0) ORDER BY id");
        while($row = mysqli_fetch_array($data)) { 
            $dish="";
            $productSQL=mysqli_query($con,"SELECT * FROM `products` WHERE Id = '$row[ProductId]' ");
            $pData=mysqli_fetch_array($productSQL);
            $catSQL=mysqli_query($con,"SELECT * FROM `categories` WHERE Id='$pData[CatId]'");
            $cData=mysqli_fetch_array($catSQL);
            $dish=$cData['Name']."/".$pData['Name'];
            echo'
                <tr id="row'.$row['Id'].'">
                    <td>'.$dish.'</td>
                    <td>'.$row["Pending"].'</td>
                    <td> 
                        <button type="button" class="btn btn-primary" onclick="orderReady('.$row['Id'].')">
                            <i class="fa fa-check"></i>
                        </button>
                        <button type="button" class="btn btn-primary" onclick="orderDeclined('.$row['Id'].')">
                            <i class="fa fa-times"></i>
                        </button>
                    </td>
                </tr>
            ';
        }
    }
    function orderReady($con,$id){
        $data = mysqli_query($con,"UPDATE `livetableorders` SET Quantity=Quantity+Pending,Pending=0 WHERE id=$id");
    
    }
    function orderDeclined($con,$id)
    {
        $data = mysqli_query($con,"UPDATE `livetableorders` SET Pending=0 WHERE id=$id");
        echo "deleted for".$id;
    }
?>