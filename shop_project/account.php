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
		$userID = $_SESSION['user'];
		openConnection();
		$query = "SELECT admin FROM users WHERE userID = $userID";
		$result = mysqli_query($connection, $query);
		while($row = mysqli_fetch_array($result))
		{
			echo $row[0];
			if($row[0] == 1)
			{
				$_SESSION['isAdmin'] = true;
				header("Location: adminAccount.php");
				break;
			}
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
    <h2>My Account</h2>
	<a href="account.php">Order history</a>
  <a href="account.php?account=general">General settings</a>
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
			$query = "SELECT * FROM orders WHERE userID = $userID";
			$orders = mysqli_query($connection, $query);
			$result = mysqli_query($connection, $query);
			echo "";
			while($row = mysqli_fetch_array($result))
			{				
?>

<div class="main">
    <div class="container">
	<h2><?php echo "Order number: " . $row[0]; ?></h2>
  <p><?php echo "Total cost: " . $row[2] . "$"; ?></p>
  <p><?php 
	  if(isset($_GET['delete']) && $_GET['delete'] === $row[0])
	  {
		  $s = "UPDATE orders SET orderStatus='Cancelled' WHERE orderID=$row[0]";
		  mysqli_query($connection, $s);
	  }
	  echo "Order status: " . $row[3];
  ?></p>
  <p><?php echo "Order date: " . $row[4]; ?></p>
  <?php echo "<a href='account.php?delete=$row[0]'>Cancel this order</a>";?>
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
	else if($_GET['account'] == 'general')
	{	
?>
<div class="main" >
    <h2>Change account details:</h2>
	<div>
	<br></br>
  <form action="accountUpdate.php">
    <label for="email" >Email:    </label><br></br>
    <input type="text1" id="email" style="margin-right: 3em" name="email" placeholder="Your E-mail..">
	<br></br>
	<label for="fname" >First Name:    </label><br></br>
    <input type="text1" id="fname" style="margin-right: 3em" name="firstname" placeholder="Your first name..">
	<br></br>
	<label for="lname" >Last Name:    </label><br></br>
    <input type="text1" id="lname" style="margin-right: 3em" name="lastname" placeholder="Your last name..">
	<br></br>
	<label for="phone" >Phone number:    </label><br></br>
    <input type="text1" id="lname" style="margin-right: 3em" name="phone" placeholder="Your phone number..">
	<br></br>
	<br></br>
	<input type="hidden"  id="lname" name="userID" value="<?php echo $_SESSION['user']; ?>" >
    <button type="submit1" readonly style='' name="Save" value="Save">Save</button>
	<br></br>
  </form>
</div>
</div>
</div>
<?php
	}
?>
</body>
</body>
</html>
<?php
	

?>


