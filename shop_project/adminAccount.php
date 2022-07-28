<?php
		session_start();
		function openConnection(){
			global $connection;
			$server = "127.0.0.1";
			$user = "root";
			$password = "";
			$dbase = "shop";
			$connection = mysqli_connect($server, $user, $password) or exit("Connection with database server failed");
			mysqli_select_db($connection, $dbase) or exit();
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
<title>SHOP</title>
<meta charset="UTF-8">
<link href="style.css" rel="stylesheet" type="text/css">
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>

* {box-sizing: border-box;}
input[type=text1], select {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
  width: 400px;

}
input[type=password1], select {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
  width: 400px;
}

button[type=submit1] {
  width: 100%;
  background-color: #4CAF50;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  text-allign:center;
  width: 200px;
}
a { text-decoration: none; }
.shopping-cart {
  width: 950px;
  height: 623px;
  margin: 50px auto;
  overflow: auto;
  background: #FFFFFF;
  box-shadow: 10px 7px 10px 10px rgba(0.10,0.10,0,0.10);
  border-radius: 6px;
  float: left;
  
}
.mini-shopping-cart {
  width: 200x;
  height: 200px;
  margin: 55px auto;
  overflow: auto;
  background: #FFFFFF;
  box-shadow: 10px 7px 10px 10px rgba(0.10,0.10,0,0.10);
  border-radius: 6px;

  float: center;
  flex-direction: column;
}
</style>
</head>

<body>
<div class="header">
<img src="images/shopLogo2.png" >
</div>

<div class="navbar">
  <a href='mainPage.php'>Home</a>
  <a href="contact.php" >Contact</a>
  <a href="author.php">Author</a>
  <input type="text" placeholder="Search..">
  <a href='log.php' class="activeRight" >Account</a>
  <a href="cart.php" class="right" >Cart</a>
</div>
<div class="row">
  <div class="side">
    <h2>Admin Account</h2>
	<a href="adminAccount.php">Orders</a>
  <a href="adminAccount.php?account=users">Users</a>
  <a href="adminAccount.php?account=products">Products</a>
  <a href="addProduct.php">Add product</a>
  <a href="logOut.php">Log Out</a>
</div>
<body>

<div class="shopping-cart"> 

<?php
	if(!isset($_GET['account']))
	{
		openConnection();
		if(isset($_SESSION['user']))
		{
			$userID =  $_SESSION['user'];
			$query = "SELECT * FROM orders";
			$orders = mysqli_query($connection, $query);
			$result = mysqli_query($connection, $query);
			echo "";
			while($row = mysqli_fetch_array($result))
			{				
		
?>

<div class="main">
    <div class="container">
	<h2><?php echo "Order number: " . $row[0]; ?></h2>
	<p><?php echo "UserID: " . $row[1]; ?></p>
  <p><?php echo "Total cost: " . $row[2] . "$"; ?></p>
  <p><?php 
	  if(isset($_GET['delete']) && $_GET['delete'] === $row[0])
	  {
		  $s = "DELETE FROM orders WHERE orderID=$row[0]";
		  mysqli_query($connection, $s);
	  }
	  echo "Order status: " . $row[3];
  ?></p>
  <p><?php echo "Order date: " . $row[4]; ?></p>
  <?php echo "<a href='adminAccount.php?delete=$row[0]'>Delete this order</a>";?>
  <div class="mini-shopping-cart"> 
  <p>Products:</p>
  <p><?php 
	$orderID = $row[0];
	$quer = "SELECT * FROM order_products WHERE orderID = $orderID";
	$products = mysqli_query($connection, $quer);
	$resul = mysqli_query($connection, $quer);
	while($ro = mysqli_fetch_array($resul))
	{
		$productID = $ro[1];
		$que = "SELECT * FROM products WHERE productID = $productID";
		$productData = mysqli_query($connection, $quer);
		$resu = mysqli_query($connection, $que);
		while($r = mysqli_fetch_array($resu))
		{
			echo $r[1] . " - ";
			echo $r[3] . "$" ; 
			if($r[6]>0){
				echo " (discount: -" . $r[6] . "$)";
			}
			echo "<br></br>";
		}
	}
  ?></p>
  </div>
	</div>
</div>
<?php
			}
		}
	else echo "No past orders.";
?>
</div>
<div class="footer">
  <h2></h2>
</div>
<?php
	}
	else if($_GET['account'] == 'users')
	{	
		openConnection();
			$userID =  $_SESSION['user'];
			$query = "SELECT * FROM users";
			$orders = mysqli_query($connection, $query);
			$result = mysqli_query($connection, $query);
			echo "";
			while($row = mysqli_fetch_array($result))
			{	
		if($row[8]==0){
?>
<div class="main">
    <div class="container">
	<h2><?php echo "UserID: " . $row[0]; ?></h2>
	<p><?php echo "Login: " . $row[1]; ?></p>
	<p><?php echo "E-mail: " . $row[3]; ?></p>
	<p><?php echo "Name: " . $row[4]; ?></p>
	<p><?php echo "Surname: " . $row[5]; ?></p>
	<p><?php echo "Birthday: " . $row[6]; ?></p>
	<p><?php echo "Mobile: " . $row[7]; ?></p>
	<p><?php 
	  if(isset($_GET['delet']) && $_GET['delet'] === $row[0])
	  {
		  $s = "DELETE FROM users WHERE userID=$row[0]";
		  mysqli_query($connection, $s);
	  }
  ?></p>
	<?php echo "<a href='adminAccount.php?account=users&delet=$row[0]'>Delete this user</a>";?>
	<br></br>
	<br></br>
	</div></div>
<?php
	}}}
	else if($_GET['account'] == 'products'){
		openConnection();
			$userID =  $_SESSION['user'];
			$query = "SELECT * FROM products";
			$orders = mysqli_query($connection, $query);
			$result = mysqli_query($connection, $query);
			echo "";
			while($row = mysqli_fetch_array($result))
			{	
?>
<div class="main">
    <div class="container">
	<h2><?php echo "ProductID: " . $row[0]; ?></h2>
	<p><?php echo "Product Name: " . $row[1]; ?></p>
	<p><?php echo "In stock: " . $row[3]; ?></p>
	<p><?php echo "Category: " . $row[4]; ?></p>
	<p><?php echo "Attributes: " . $row[5]; ?></p>
	<p><?php echo "Price: " . $row[2] . "$"; ?></p>
	<p><?php echo "Promotion: " . $row[6] . "$"; ?></p>
	<?php echo "<img src='".$row[7]."' style='width:20%'/>"; ?>
	<p><?php 
	  if(isset($_GET['dele']) && $_GET['dele'] === $row[0])
	  {
		  $s = "DELETE FROM products WHERE productID=$row[0]";
		  mysqli_query($connection, $s);
	  }
  ?></p>
	<?php echo "<a href='adminAccount.php?account=products&dele=$row[0]'>Delete this product</a>";?>
	<br></br>
	<br></br>
	</div></div>
<?php
	}}

?>
</body>
</body>
</html>

