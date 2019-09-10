<?php
    include "../../config.php";
    $mycon = new config();
    $con = $mycon->db();
    $flag="";
    $id="";
    if(isset($_POST['flag'])) $flag = $_POST['flag'];
    else echo "<script>window.location='index.php';</script>";
    
    if($flag=="search") search($con);

    function search($con)
    {
        $type = $_POST['type'];
        $query = $_POST['query'];

        //$data = mysqli_query($con,"SELECT categories.Name,products.Name AS PName,products.Price FROM products INNER JOIN categories WHERE products.CatId=categories.Id AND products.Name LIKE '$query%' OR categories.Name LIKE '$query%' GROUP BY categories.Name ORDER BY categories.Name");
        $data = mysqli_query($con,"SELECT categories.Name,products.Name AS PName,products.Price,products.IsAvailable FROM products JOIN categories ON products.CatId=categories.Id WHERE products.Name LIKE '$query%' OR categories.Name LIKE '$query%' ORDER BY CatId");

        if($data == null)
            return;
        $categories = array(array());
        while($row = mysqli_fetch_array($data)){
            $categories[$row['Name']][] = array($row['PName'],$row["Price"],$row["IsAvailable"]);
            // if($row[0] != @$CatName)
            // {
            //     $CatName = $row[0];
            //     echo "<hr><h3>".$CatName."</h3>";
            // }
            // print_r($row);
            // echo "<br>";
        }
        
        foreach($categories as $catKey => $cat)
        {
            if($catKey != "0")
            {
                echo "
                <div class='menu-tables col-lg-3 col-md-4 col-sm-6 col-sm-6 col-xs-offset-0 col-xs-12   lign-self-start justify-content-end'>
                <div id='tables'>
                <table class='table table-striped'>
                <thead class='thead-light'>
                    <tr>
                        <th colspan=3>$catKey</th>
                    </tr>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <td style='font-weight:bold;' align=center>Price</td>
                    </tr>
                </thead>
                ";
                $i =1;
                foreach($cat as $item)
                {
                    $class = "";
                    if($item[2] == '0')
                        $class = "item-UnAvailable";
                    echo "
                    <tbody>
                        <tr class='$class'>
                            <td>".$i++."</td>
                            <td>$item[0]</td>
                            <td align=center>$item[1]</td>
                        </tr>
                    </tbody>";
                }
                echo"</table></div></div>";
            }
        }
    }
?>