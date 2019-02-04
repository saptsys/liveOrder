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
    if($flag=="addUserDB") addUser($con,true);
    if($flag=="addTable") addTable($con);
    if($flag=="addTableDB") addTable($con,true);
    if($flag=="updateTable") addTable($con,true,true);
    if($flag=="updateUser") addUser($con,true,true);
    function getUsers($con){
        $query=mysqli_query($con,"SELECT * FROM `users`");
        if(mysqli_affected_rows($con) != 0){
            while( $fetch=mysqli_fetch_assoc($query)){
                echo'
                    <tr id="user'.$fetch["Id"].'">
                        <td class="srno">'.$fetch["Id"].'</td>
                        <td class="name">'.$fetch["FirstName"].' '.$fetch["LastName"].'</td>
                        <td class="role">'.$fetch["Role"].'</td>
                        <td>
                            <button onclick="editUser('.$fetch["Id"].')" style="text-align:center" type="button" class="btn btn-primary-outline">
                                <i style="color:orange" class="fa fa-pencil-alt"></i>
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
                        <td class="srno">'.$fetch["Id"].'</td>
                        <td>'.$fetch["Name"].'</td>
                        <td>'.$fetch["Capacity"].'</td>
                        <td>
                            <button onclick="editTable('.$fetch["Id"].')" style="text-align:center" type="button" class="btn btn-primary-outline">
                                <i style="color:orange" class="fa fa-pencil-alt"></i>
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
    function addUser($con,$db=false,$update=false){
        if($db){
            $firstName=$_POST['firstName'];
            $lastName=$_POST['lastName'];
            $role=$_POST['role'];
            $password=sha1(md5($_POST['password']));
            $userName=$_POST['userName'];
            if($update) {
                $id=$_POST['id'];
                $sql="UPDATE `users` SET `FirstName` = '$firstName',`LastName` = '$lastName', `Username` = '$userName', `Password` = '$password', `Role` = '$role' WHERE `users`.`Id` = $id"; 
            }else{
                $sql="INSERT INTO `users` (FirstName,LastName,Username,Password,Role)
                 VALUES('$firstName','$lastName','$userName','$password','$role')";
            }
            if(mysqli_query($con,$sql)){
                echo "true";
            }else{
                echo "false";
            }
        }else{
           echo"
                <form>
                    <fieldset>
                        <input required placeholder='First Name' type='text' name='firstName' id='firstName' class='text ui-widget-content ui-corner-all'>
                        <input required placeholder='Last Name' type='text' name='lastName' id='lastName'  class='text ui-widget-content ui-corner-all'>
                        <input required placeholder='User Name' type='text' name='userName' id='userName' class='text ui-widget-content ui-corner-all'>
                        <select required name='role' id='role'>
                            <option disabled selected>Select Role</option>
                            <option value='Admin'>Admin</option>
                            <option value='Chef'>Chef</option>
                            <option value='Waiter'>Waiter</option>
                        </select> 
                        <input required type='password' name='password' id='password' placeholder='*******' class='text ui-widget-content ui-corner-all'>
                    </fieldset>
                </form>
            "; 
        }
    }
    function addTable($con,$db=false,$update=false){
        if($db){
            $tblName=$_POST['tblName'];
            $capacity=$_POST['capacity'];
            if($update) {
                $id=$_POST['id'];
                $sql="UPDATE `tables` SET `Name` = '$tblName', `Capacity` = '$capacity' WHERE `tables`.`Id` = $id"; 
            }else{
                $sql="INSERT INTO `tables` (Name,Capacity)
                 VALUES('$tblName','$capacity')";
            }
            if(mysqli_query($con,$sql)){
                echo "true";
            }else{
                echo "false";
            }
        }else{
            echo"
                <form>
                    <fieldset>
                        <input placeholder='Table Name' type='text' name='tblName' id='tblName' placeholer='TableName' class='text ui-widget-content ui-corner-all'>
                        <input placeholder='10' type='number' name='capacity' id='capacity'  placeholer='capacity' class='text ui-widget-content ui-corner-all'>
                    </fieldset>
                </form>
            "; 
        }
    }
    function editUser($con,$id){
        $sql=mysqli_query($con,"SELECT * FROM `users` WHERE Id=$id LIMIT 1");
        $fetch=mysqli_fetch_assoc($sql);
        echo"
            <form>
            <fieldset>
                <input required value='$fetch[FirstName]' type='text' name='firstName' id='firstName' placeholder='firstName' class='text ui-widget-content ui-corner-all'>
                <input required value='$fetch[LastName]' type='text' name='lastName' id='lastName'  placeholder='Last Name' class='text ui-widget-content ui-corner-all'>
                <input required value='$fetch[Username]' type='text' name='userName' id='userName'  placeholder='User Name' class='text ui-widget-content ui-corner-all'>
                <select required name='role' id='role'>
                    <option disabled selected>Select Role</option>
                    <option value='Admin'>Admin</option>
                    <option value='Chef'>Chef</option>
                    <option value='Waiter'>Waiter</option>
                </select> 
                <input placeholder='password' required type='password' name='password' id='password' class='text ui-widget-content ui-corner-all'>
            </fieldset>
            </form>
        ";
    }
    function editTable($con,$id){
        $sql=mysqli_query($con,"SELECT * FROM `tables` WHERE Id=$id LIMIT 1");
        $fetch=mysqli_fetch_assoc($sql);
        echo"
            <form>
                <fieldset>
                    <input value=$fetch[Name] type='text' name='tblName' id='tblName' placeholder='TableName' class='text ui-widget-content ui-corner-all'>
                    <input value=$fetch[Capacity] type='number' name='capacity' id='capacity'  placeholder='Capacity' class='text ui-widget-content ui-corner-all'>
                </fieldset>
            </form>
        ";
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