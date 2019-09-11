<!-- <span>Creating Database : <div id="lab" style="height:20px;width:100%;background:green;"><div></span> -->

<?php
$ok=false;
if( (isset($_COOKIE['user'])) && ( isset($_COOKIE['pass']) ) ){
	echo "You need to <a href='../lib/logout.php?flag=dbini'>Logout</a> first !";	
}
else
{?>
<html lang="en">
<head>
	<title>Database Management</title>
	<style>
	hr{
		border:1px dotted #ddd;
	}
	</style>
</head>
<body>
<h3>Database Management</h3>
	<form action="" method="post">
		Enter Code : <input type="password" required name="code"/>
		<input type="submit" name="initialize_btn" value="Initialize"/>		
		<!-- <input type="submit" name="prepare_btn" value="Prepare"/>		 -->
	</form>
	<hr style="border:1px solid #aaa;" ><br>
</body>
</html>
<?php
}

if(isset($_POST["initialize_btn"]))
{
	if($_POST["code"] == "jack4sparrow")
	{
		echo "Initialization started...";
	
	include "../config.php";
	$mycon = new config();
	$conn = $mycon->dbOnlyCon();
	$dbName = $mycon->db;

	$result = mysqli_query($conn,"SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '$mycon->db'")or die("Dead at index page..");
    $row = mysqli_num_rows($result);
	if($row <= 0 && $mycon->pass != "")
		die("<i>'$mycon->db' Database not exist, you need create first & retry</i>");
	// else
	// 	mysqli_query($conn,"CREATE DATABASE `$dbName`")or die("<hr>DB '$dbName' already exist !");
	
	mysqli_select_db($conn,"$dbName");

	if($mycon->pass != "")
	{
		$sqlScript = file('https://raw.githubusercontent.com/liveOrder/liveOrder/master/Database/Current.sql');
		echo "<hr>Schema fetched from repository";
	}
	else
	{
		$sqlScript = file('Current.sql');
		echo "<hr >Schema fetched from local file";
	}

	$tableData = mysqli_query($conn,"SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_TYPE = 'BASE TABLE' AND TABLE_SCHEMA='$mycon->db'");
	echo "<hr> Overwriting tables<br>";
	while($row = mysqli_fetch_array($tableData))
	{
		echo "<br/>".$row[0];
		mysqli_query($conn,"DROP TABLE IF EXISTS $row[0]") or die("Table '$row[0]' not deleted.");
	}

	$query = '';
	foreach ($sqlScript as $line)	{
	
		$startWith = substr(trim($line), 0 ,2);
		$endWith = substr(trim($line), -1 ,1);
		
		if (empty($line) || $startWith == '--' || $startWith == '/*' || $startWith == '//') {
			continue;
		}
			
		$query = $query . $line;
		if ($endWith == ';') {
			mysqli_query($conn,$query) or die('<div class="error-response sql-import-response">Problem in executing the SQL query <b>' . $query. '</b></div>');
			$query= '';		
		}
	}
	echo "<hr>Database initialized successfuly<br>Click here to <a href='../screens/Menu'>Home Page</a><hr>";
	}
	else
	{
		echo "
		<script>
			alert('Wrong password!!');
		</script>
		";
	}
}

// if(isset($_POST["prepare_btn"]))
// {
// 	if($_POST["code"] == "jack4sparrow")
// 	{
// 		echo "Preparing started...";
	
// 		include "../config.php";
// 		$mycon = new config();
// 		$conn = $mycon->dbOnlyCon();
// 		$dbName = $mycon->db;

// 		$result = mysqli_query($conn,"SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '$mycon->db'")or die("Dead at index page..");
// 		$row = mysqli_num_rows($result);
// 		if($row <= 0)
// 			die("<i>'$mycon->db' Database not exist, you need create first & retry</i>");

// 			$filename='Current_test.sql';

// 			$result=exec("mysqldump -u root -p liveorder >file_to_write_to.sql".$filename,$output);
			
// 			if($output=='') echo "<hr/> Database preapred successfuly";
// 			else 
// 			{
// 				echo "<hr/>Database Preparation failed :";
// 				print_r($output);
// 			}

// 		$tableData = mysqli_query($conn,"SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_TYPE = 'BASE TABLE' AND TABLE_SCHEMA='$mycon->db'");
// 		echo "<hr> Tables are : <br>";
// 		while($row = mysqli_fetch_array($tableData))
// 		{
// 			echo "<br/>".$row[0];
// 		}
// 	}
// }
?>