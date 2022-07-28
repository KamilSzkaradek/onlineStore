<?php
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
<head>
<link href="style.css" rel="stylesheet" type="text/css">
  <meta charset="utf-8">
  <title>Registration</title>
  <style> input[type='text'] { text-align: left } 
  
  .container {
    position: absolute;
    top: 46%;
    left: 50%;
	
    -moz-transform: translateX(-50%) translateY(-50%);
    -webkit-transform: translateX(-50%) translateY(-50%);
    transform: translateX(-50%) translateY(-50%);
	}
  </style>
</head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<div class="header">
<img src="images/shopLogo2.png" >
</div>

<div class="navbar">
  <a href='mainPage.php' >Home</a>
  <a href="contact.php">Contact</a>
  <a href="author.php">Author</a>
  <input type="text" placeholder="Search.." name="search">
  <a href='log.php' class="activeRight">Account</a>
  <a href="cart.php" class="right">Cart</a>
</div>

<body style='background: white; color: black'> 
<div class="container">
<br><center>

<br><center>
<body style='background: white; color: black'>
<br><center>
<?php 
if(isset($_GET['id']) && strlen($_GET['id'])>1 
	&& isset($_GET['name']) && isset($_GET['stock'])
	&& isset($_GET['price']) && isset($_GET['category'])
	&& isset($_GET['image']))
{
	$productID = $_GET['id'];
	$name = $_GET['name'];
	$stock = $_GET['stock'];
	$price = $_GET['price'];
	$category = $_GET['category'];
	if(isset($_GET['attributes'])){$attributes = $_GET['attributes'];}
	else ($attributes = " ");
	if(isset($_GET['promotion']) && is_numeric($_GET['promotion'])){$promotion = $_GET['promotion'];}
	else ($promotion = 0);
	$image = $_GET['image'];
	
	openConnection();
	$query = "INSERT INTO products VALUES ('$productID', '$name',
	'$stock', '$price', '$category', '$attributes', '$promotion', '$image')";
	$orders = mysqli_query($connection, $query);
	closeConnection();
}
else
{
?>

<div class="container">
<form action="addProduct.php" method="get"> 
<table border=0>
<tr>
<td>ProductID:</td><td colspan=2><input type=text name='id' size=15 style='text-align: left'></td>
</tr>
<tr>
<td>Product name:</td><td colspan=2><input type=text name='name' size=15 style='text-align: left'></td>
</tr>
<tr>
<td>In stock:</td><td colspan=2><input type=text name='stock' size=15 style='text-align: left'></td>
</tr>
<tr>
<td>Price:</td><td colspan=2><input type=text name='price' size=15 style='text-align: left'></td>
</tr>
<tr>
<td>Category:</td><td colspan=2><input type=text name='category' size=15 style='text-align: left'></td>
</tr>
<tr>
<td>Attributes:</td><td colspan=2><input type=text name='attributes' size=15 style='text-align: left'></td>
</tr>
<tr>
<td>Promotion:</td><td colspan=2><input type=text name='promotion' size=15 style='text-align: left'></td>
</tr>
<tr>
<td>Image path:</td><td colspan=2><input type=text name='image' size=15 style='text-align: left'></td>
</tr>
<tr>
<td colspan=3><input type=submit value='Add product' style='width:200'></td>
</tr>
</table>
</form>
</div>
</div>
<?php
	}
?>


</center>
</body>
</html>
