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

    function getTable($con)
    {  
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
                    <h5>$class</h5>
                </div>
            </div><!-- .dining-table -->";
        }
    }
?>