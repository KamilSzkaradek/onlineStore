<?php
	session_start();
	function openConnection(){
			global $connection;
			$server = "127.0.0.1";
			$user = "root";
			$password = "";
			$dbase = "shop";

			$connection = mysqli_connect($server, $user, $password) or exit("Connection with database server failed");
			mysqli_select_db($connection, $dbase) or exit("Connection with database $dbase failed");
			mysqli_set_charset($connection, "utf8");
		}
		
		function closeConnection(){
			global $connection;
			mysqli_close($connection);
		}
		
?>
<html>
<html lang="en">
<head>
<link href="style.css" rel="stylesheet" type="text/css">
<title>SHOP</title>
<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=3">
<style>
* {box-sizing: border-box;}
.main {   
  -ms-flex: 70%; /* IE10 */
  flex: 70%;
  background-color: white;
  padding: 70px;
  width: 1200px;

}
</style>
</head>
<body>
<div class="header">
<img src="images/shopLogo2.png" >
</div>

<div class="navbar">
  <a href='mainPage.php'>Home</a>
  <a href="contact.php" class="active">Contact</a> 
  <a href="author.php">Author</a>
  <form class="searchBar" action="searchResults.php" method="GET">
  <input type="text" placeholder="Search.." name="search">
</form>
  <a href='log.php' class="right">Account</a>
  <a href="cart.php" class="right">Cart</a>
</div>

<script type="text/javascript" src="1.js"></script>

<div class="main">
	<h1 style="text-align:center;">Order successful!</h1>
	<br></br>
  </div>
</div>
<?php 		
	openConnection();
	$query = "select * from products";
	$products = mysqli_query($connection, $query) or exit("Query: $query failed");
	$result = mysqli_query($connection, $query);	
	$orderProducts = array();
	
	//IF THERE IS AT LEAST ONE PRODUCT IN GET ARRAY
	if(sizeof($_GET)>2)
{
	while($row = mysqli_fetch_array($result))
	{	
		if (in_array($row[7] , $_GET))
		{
				$orderProducts[] = $row[7];
		}
			
	}
	
	//GET HIGHEST orderID
	$query = "SELECT MAX(orderID) FROM orders;";
	$highestOrderID = mysqli_query($connection, $query) or exit("Query: $query failed");
	while($row = mysqli_fetch_array($highestOrderID))
	{	
		$highestOrderID = $row[0];
		break;	
	}
	
	$highestOrderID = $highestOrderID+1;
	
	
	//INSERT ORDERED PRODUCTS INTO order_products AND COUNT ORDER PRICE
	$fullPrice = 0;
	foreach ($orderProducts as &$value) 
	{
		$query = "SELECT productID, price, promotion FROM products WHERE imagePath LIKE '$value'";
		$productValues = mysqli_query($connection, $query);
		while($row = mysqli_fetch_array($productValues))
		{
			if($row[2]<1)
			{
				$sql="INSERT INTO order_products (orderID, productID, quantity, price, discount)
				VALUES ($highestOrderID, $row[0], 1, $row[1], 0)";
				mysqli_query($connection, $sql);
			}
			else
			{
				$sql="INSERT INTO order_products (orderID, productID, quantity, price, discount)
				VALUES ($highestOrderID, $row[0], 1, $row[1], $row[2])";
				mysqli_query($connection, $sql);
			}
			
			if($row[2]>0)
			{
				$fullPrice = $fullPrice + ($row[1]-$row[2]);
			}
			else
			{
				$fullPrice = $fullPrice + $row[1];
			}
		}
	}
	$currentDate = date("Y-m-d");
	
	
	//CREATE NEW ORDER
	$userID = 0;
	if(isset($_SESSION['user']))
	{
		$userID =  $_SESSION['user'];
	}
	$query="INSERT INTO `orders`(`orderID`, `userID`, `fullPrice`, `orderStatus`, `orderDate`,
	`shippedDate`) VALUES ('$highestOrderID',$userID,$fullPrice,'Processing','$currentDate','0')";
	
	mysqli_query($connection, $query);
	closeConnection();
}
 ?>

</body>
</html>
