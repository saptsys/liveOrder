<?php
    session_start();
    include "../../config.php";
    $mycon = new config();
    $con = $mycon->db();
    
    $flag="";
    if(isset($_POST['flag']))
        $flag = $_POST['flag'];
    else
        echo "<script>window.location='index.php';</script>";
    
    if($flag=="getTable") getTable($con);    
    if($flag=="getMenu") getMenu($con);
    if($flag=="itemSelected") itemsSelected($con,$_POST['selectedItems'],$_POST['tableId']);
    if($flag=="getOrderedList") getOrderedList($con,$_POST['tableId']);
    if($flag=="getInvoice") getInvoice($con,$_POST['tableId']);
    if($flag=="sendMail") sendMail($_POST['emailId'],$_POST['content']);
    if($flag=="getKitchen") getKitchen($con);
    if($flag=="itemTaked") itemTaked($con,$_POST['id']);
    if($flag=="countKitchen") countKitchen($con);
    if($flag=="feedback") feedback($con);
    if($flag=="ChangePending") ChangePending($con,$_POST['kitchenId'],$_POST['actionFlag']);

    
    
    
    
    function feedback($con){
        print_r($_POST);
    }
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
                mysqli_query($con,"UPDATE `kitchen` SET Pending=Pending+$productQuantity,isReady=0 WHERE `Id`=$row[0] AND `ProductId`=$productId AND `TableId`=$tableId") or die("error to increase available pending items");
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
        $data = mysqli_query($con,"SELECT c.Name `categories`, p.Name `products`, k.Quantity `kitchen`, k.Pending `kitchen`,k.isReady `kitchen`,k.Id `kitchen`
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
            if($row[4]==0 && $row[2]>0)
            {
                $served="Yes";
            }
            else
            {
                $served="No";
            }

            $content="
                <span>
                <i class='fa fa-minus' onclick='subtractPending($row[5])'></i>
                    <b id='P$row[5]' class='counter'>$row[3]</b>
                    <i class='fa fa-plus' onclick='addPending($row[5])'></i>
                </span>
            ";

            echo "
                <tr>
                    <td>$row[0] $row[1]</td>
                    <td>$content</td>
                    <td> $served : $row[2]</td>
                </tr>
            ";
        }
        echo'
            <div class="mobile" >
                <input placeholder="Mobile.." type="number" name="" id="mobile" class="form-control" value="" min={5} max="" step="" required="required" title="">
            </div>
        ';
        echo "</tbody>
        </table>";
    }

    function getInvoice($con,$tableId)
    {
        $data = mysqli_query($con,"SELECT max(`Id`) FROM `invoices`");
        $invoiceId = mysqli_fetch_array($data);
        if($invoiceId[0]=='')
            $invoiceId[0]=0;
        $invoiceId[0]++; //pre invoices genrated id
        //storing data kitchen to invoicesItems
        mysqli_query($con,"INSERT INTO `invoiceitems`(`InvoiceId`,`ProductId`, `Quantity`, `Rate`, `Amount`) 
                                                  SELECT $invoiceId[0], k.ProductId `kitchen`,k.Quantity `kitchen`,p.Price `products`,k.Quantity*p.Price 
                                                  FROM `kitchen` k,`products` p 
                                                  WHERE k.TableId=$tableId AND k.ProductId=p.Id");
        //delete record from kitchen
        mysqli_query($con,"DELETE FROM `kitchen` WHERE `TableId`=$tableId;");
        //calculating gross amount from invoicesItem table
        $grossAmount=0;
        $data = mysqli_query($con,"SELECT `Amount` FROM `invoiceitems` WHERE `InvoiceId`=$invoiceId[0]") or die("grorss amount not calculated");
        while($row = mysqli_fetch_array($data))
        {
            $grossAmount+=(int)$row[0];
        }
        //setting table to non occupied table
        mysqli_query($con,"UPDATE `tables` SET `IsOccupied`=0 WHERE `Id`=$tableId") or die("error to set is occupied = 0");
        //calculating GST by 18% and calculating totalamount
        $gstAmount = $grossAmount*18/100; // gst by 18%
        $totalAmount = $grossAmount + $gstAmount;
        //getting the current waiter username
        $waiterUsername = $_SESSION['user'];

        //counting costomertime
        //$cTime = mysqli_query($con,"SELECT `Mobile` FROM `customer` WHERE ")
        //inserting to invoice.
        mysqli_query($con,"INSERT INTO `invoices`(`Id`, `TableId`, `GrossAmount`, `GSTP`, `GSTRs`, `TotalAmount`, `Waiter`) 
                           VALUES (null,$tableId,$grossAmount,18,$gstAmount ,$totalAmount,'$waiterUsername')") or die("Error to insert record into invoices");

        $data_invoices = mysqli_query($con,"SELECT * FROM `invoices` WHERE `TableId`=$tableId ORDER BY `Id` DESC LIMIT 1");
        $row_invoices = mysqli_fetch_array($data_invoices);

        $data_invoiceItems = mysqli_query($con,"SELECT p.Name `products`,i.Quantity `invoiceitems`,i.Rate `invoiceitems`,i.Amount `invoiceitems`
                                                FROM `invoiceitems` i,`products` p
                                                WHERE i.InvoiceId=$row_invoices[0] AND p.Id=i.ProductId");
        echo " <table class='table table-striped'> 
        <thead class='thead-light'>
            <tr>
                <td><b>Item Name</b></td>
                <td><b>Rate</b></td>
                <td><b>Amount</b></td>
            </tr>
        </thead>
        <tbody>
        ";
        while($row_invoiceItems = mysqli_fetch_array($data_invoiceItems))
        {
            echo "
                <tr>
                    <td>$row_invoiceItems[0] x$row_invoiceItems[1]</td>
                    <td> $row_invoiceItems[2]</td>
                    <td> $row_invoiceItems[3]</td>
                </tr>
            ";
        }
        echo "
        <tr id='printing_row'><td colspan='3'><hr></td></tr>
        <tr>
            <td><b>Gross Amount</b></td>
            <td><b>=</td>
            <td><b>$grossAmount</b></td>
        </tr>
        <tr>
            <td><b>GST 18%</b></td>
            <td><b>=</b></td>
            <td><b>$gstAmount</b></td>
        </tr>
        <tr>
            <td><b>Discount 10%</b></td>
            <td><b>=</b></td>
            <td><b>121</b></td>
        </tr>
        <tr id='printing_row'><td colspan='3'><hr></td></tr>
        <tr>
            <td><b>Total</b></td>
            <td><b>=</b></td>
            <td><b>$totalAmount</b></td>
        </tr>
        </tbody>
        </table>";
    }
    function sendMail($emailId,$content)
    {

        // use wordwrap() if lines are longer than 70 characters
        $content = wordwrap($content,70);

        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        // send email
        mail($emailId,"Your invoice is here",$content,$headers);
    }


    function getKitchen($con)
    {
        $data = mysqli_query($con,"SELECT t.Name `tables`,p.Name `products`,c.Name `categories`,k.Quantity,k.Id
                           FROM `tables` t,`products` p,`categories` c,`kitchen` k
                           WHERE k.isReady=1 AND k.TableId=t.Id AND k.ProductId=p.Id AND p.CatId=c.Id");
        echo "
            <table id='kitchenTable' style='text-align:center;' class='table table-striped'>
                <tr>
                    <td><b>Table</b></td>
                    <td><b>Item</b></td>
                    <td><b>Quantity</b></td>
                    <td><b>Action</b></td>
                </tr>
        ";
        while($row = mysqli_fetch_array($data))
        {
            echo "<tr id='ktchen$row[4]'>
            <td>$row[0]</td>
            <td>$row[2] $row[1]</td>
            <td>$row[3]</td>
            <td><button class='btn btn-success' onclick='takedKitchen($row[4])'>Take it</button></td>
            </tr>";
        }
        echo "
        </table>        
        ";
        if(mysqli_affected_rows($con)==0)
        {
            echo "
            <p id='noItemText'>
                <br><br><br><br>
                <center><h4>No item available !</h4></center>
            </p>
            ";
        }
    }
    function itemTaked($con,$kitchenId)
    {
        mysqli_query($con,"UPDATE `kitchen` SET `isReady`=0 WHERE `Id`=$kitchenId");
        echo $kitchenId;
    }

    function countKitchen($con)
    {
        $sum=0;
        $data = mysqli_query($con,"SELECT SUM(isReady) FROM `kitchen`");
        $row = mysqli_fetch_array($data);
        echo $row[0];
    }

    function ChangePending($con,$kitchenId,$action)
    {
        if($action=="add"){
            mysqli_query($con,"UPDATE `kitchen` SET `Pending`=`Pending`+1 WHERE `Id`=$kitchenId");
        }
        if($action=="sub")
        {
            mysqli_query($con,"UPDATE `kitchen` SET `Pending`=`Pending`-1 WHERE `Id`=$kitchenId");
        }
        echo $kitchenId;
    }
?>