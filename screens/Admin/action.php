<?php
    include "../../config.php";
    $mycon = new config();
    $con = $mycon->db();
    $flag="";
    $id="";
    if(isset($_POST['flag'])) $flag = $_POST['flag'];
    else echo "<script>window.location='index.php';</script>";
    
    if($flag=="getUsers") getUsers($con);
    if($flag=="getOrders") getOrders($con);
    if($flag=="getTables") getTables($con);
    if($flag=="editUser") editUser($con,$_POST['id']);
    if($flag=="editTable") editTable($con,$_POST['id']);
    if($flag=="deleteUser") deleteUser($con,$_POST['id']);
    if($flag=="deleteTable") deleteTable($con,$_POST['id']);
    if($flag=="addUser") addUser($con);
    if($flag=="addTable") addTable($con);

    function getUsers($con){
        $query=mysqli_query($con,"SELECT * FROM `users`");
        if(mysqli_affected_rows($con) != 0){
            while( $fetch=mysqli_fetch_assoc($query)){
                echo'
                    <tr id="user'.$fetch["Id"].'">
                        <td class="name">'.$fetch["FirstName"].' '.$fetch["LastName"].'</td>
                        <td class="role">'.$fetch["Role"].'</td>
                        <td>
                            <button onclick="editUser('.$fetch["Id"].')" style="text-align:center" type="button" class="btn btn-primary-outline">
                                <i style="color:#ff704d" class="fa fa-pencil-alt"></i>
                            </button>
                            <button onclick="deleteUser('.$fetch["Id"].')" style="text-align:center" type="button"  class="btn btn-primary-outline">
                                <i style="color:#ff6666" class="fa fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                ';
            }
        }else{
            echo '
                <tr>
                    <td colspan=3><center> no  data</center></td>
                </tr>
            ';
        }
    }
    function getTables($con){
        $query=mysqli_query($con,"SELECT * FROM `tables`");
        if(mysqli_affected_rows($con) != 0){
            while( $fetch=mysqli_fetch_assoc($query)){
                echo'
                    <tr id="table'.$fetch["Id"].'">
                        <td>'.$fetch["Name"].'</td>
                        <td>'.$fetch["Capacity"].'</td>
                        <td>
                            <button onclick="editTable('.$fetch["Id"].')" style="text-align:center" type="button" class="btn btn-primary-outline">
                                <i style="color:#ff704d" class="fa fa-pencil-alt"></i>
                            </button>
                            <button onclick="deleteTable('.$fetch["Id"].')" style="text-align:center" type="button"  class="btn btn-primary-outline">
                                <i style="color:#ff6666" class="fa fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                ';
            }
        }else{
            echo '
                <tr>
                    <td colspan=3><center> no  data</center></td>
                </tr>
            ';
        }
    }
    function addUser($con){
        echo "addUser";
    }
    function addTable($con){
        echo "addTable";
    }
    function editUser($con,$id){
        echo "editUser";
    }
    function editTable($con,$id){
        echo "editTable";
    }
    function deleteUser($con,$id){
        if(mysqli_query($con,"DELETE FROM `users` WHERE id=$id")) echo "1";
        else echo "0";
    }
    function deleteTable($con,$id){
        if(mysqli_query($con,"DELETE FROM `tables` WHERE id=$id")) echo "1";
        else echo "0";
    }
?>