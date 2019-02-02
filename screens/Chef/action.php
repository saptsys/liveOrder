<?php
    include "../../config.php";
    $mycon = new config();
    $con = $mycon->db();
    $flag="";
    $id="";
    if(isset($_POST['flag'])) $flag = $_POST['flag'];
    else echo "<script>window.location='index.php';</script>";
    
    if($flag=="getOrders") getOrders($con);

    //under construction
    if($flag=="checkDb"){
        $id=$_POST['id'];
        checkDb($con,$id);
    } 
    if($flag=="orderReady"){
        $id=$_POST['id'];
        orderReady($con,$id);
    } 
    if($flag=="orderDeclined"){
        $id=$_POST['id'];
        orderDeclined($con,$id);
    }

    function getOrders($con)  {  
        $data = mysqli_query($con,"SELECT * FROM `kitchen` WHERE NOT(Pending = 0) ORDER BY time");
        if(mysqli_affected_rows($con) != 0){
            while($row = mysqli_fetch_array($data)) { 
                $dish="";
                $productSQL=mysqli_query($con,"SELECT * FROM `products` WHERE Id = '$row[ProductId]' ");
                $pData=mysqli_fetch_array($productSQL);
                $catSQL=mysqli_query($con,"SELECT * FROM `categories` WHERE Id='$pData[CatId]'");
                $cData=mysqli_fetch_array($catSQL);
                $dish=$cData['Name']." / ".$pData['Name']." @ ".$row['TableId'];
                echo'
                    <tr id="row'.$row['Id'].'">
                        <td>'.$dish.'</td>
                        <td>'.$row["Pending"].'</td>
                        <td>
                            <button type="button" class="btn btn-primary" onclick="orderReady('.$row['Id'].')">
                                <i class="fa fa-check"></i>
                            </button>
                            <button type="button" class="btn btn-danger" onclick="orderDeclined('.$row['Id'].')">
                                <i class="fa fa-times"></i>
                            </button>
                        </td>
                    </tr>
                ';
            }
        }else{
            echo "no orders...";
        }
    }
    function orderReady($con,$id){
        $data = mysqli_query($con,"UPDATE `kitchen` SET Quantity=Quantity+Pending,Pending=0 WHERE id=$id");
    
    }
    function orderDeclined($con,$id)
    {
        $data = mysqli_query($con,"UPDATE `kitchen` SET Pending=0 WHERE id=$id");
    }
    //this function is under constructio..
    function checkDb($con,$id){
        $stmt="SELECT id FROM `livetableorder` WHERE id > $id";
        if(mysqli_query($con,$stmt)){
            if(msql_affected_rows($con) != 0){
                $data = mysqli_query($con,"SELECT * FROM `kitchen` WHERE NOT(Pending = 0) AND time > $time ORDER BY time");
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
                                <button type="button" class="btn btn-danger" onclick="orderDeclined('.$row['Id'].')">
                                    <i class="fa fa-times"></i>
                                </button>
                            </td>
                        </tr>
                    ';
                }
            }else echo "null";
        }else echo "null";
    }
?>