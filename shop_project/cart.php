<?php
	session_start();
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
.shopping-cart {
  width: 950px;
  height: 623px;
  margin: 80px auto;
  overflow: auto;
  background: #FFFFFF;
  box-shadow: 10px 7px 10px 10px rgba(0.10,0.10,0,0.10);
  border-radius: 6px;
  display: flex;
  flex-direction: column;
}
.item {
  padding: 20px 30px;
  height: 120px;
  display: flex;
}
 
.title {
  height: 60px;
  border-bottom: 1px solid #E1E8EE;
  padding: 20px 30px;
  color: #5E6977;
  font-size: 18px;
  font-weight: 400;
}
 
.item {
  padding: 20px 30px;
  height: 120px;
  display: flex;
}
 
.item:nth-child(3) {
  border-top:  1px solid #E1E8EE;
  border-bottom:  1px solid #E1E8EE;
}
.buttons {
	
  position: relative;
  padding-top: 30px;
  margin-right: 60px;
}
.delete-btn,
.like-btn {
  display: inline-block;
  Cursor: pointer;
}
.delete-btn {
  width: 18px;
  height: 17px;
  background: url(&amp;quot;delete-icn.svg&amp;quot;) no-repeat center;
}
 
.like-btn {
	
  position: absolute;
  top: 9px;
  left: 15px;
  background: url('twitter-heart.png');
  width: 60px;
  height: 60px;
  background-size: 2900%;
  background-repeat: no-repeat;
}
.is-active {
  animation-name: animate;
  animation-duration: .8s;
  animation-iteration-count: 1;
  animation-timing-function: steps(28);
  animation-fill-mode: forwards;
}
 
@keyframes animate {
  0%   { background-position: left;  }
  50%  { background-position: right; }
  100% { background-position: right; }
}


.description {
  padding-top: 10px;
  margin-right: 60px;
  width: 115px;
}
 
.description span {
  display: block;
  font-size: 14px;
  color: #43484D;
  font-weight: 400;
}
 
.description span:first-child {
  margin-bottom: 5px;
}
.description span:last-child {
  font-weight: 300;
  margin-top: 8px;
  color: #86939E;
}
.quantity {
  padding-top: 20px;
  margin-right: 60px;
}
.quantity input {
  -webkit-appearance: none;
  border: none;
  text-align: center;
  width: 32px;
  font-size: 16px;
  color: #43484D;
  font-weight: 300;
}
 
form[class*=btn] {
	-webkit-appearance: button;
    -moz-appearance: button;
    appearance: button;
    text-decoration: none;
    color: initial;
  width: 20px;
  height: 20px;
  background-color: #E1E8EE;
  border-radius: 6px;
  border: none;
  cursor: pointer;
}
.minus-btn img {
	
  margin-bottom: 3px;
}
.plus-btn img {
  margin-top: 2px;
}
 
form:focus,
input:focus {
  outline:0;
}
.total-price {
  width: 83px;
  padding-top: 27px;
  text-align: center;
  font-size: 16px;
  color: #43484D;
  font-weight: 300;
}
@media (max-width: 800px) {
  .shopping-cart {
    width: 100%;
    height: auto;
    overflow: hidden;
  }
  .item {
    height: auto;
    flex-wrap: wrap;
    justify-content: center;
  }
 
  .buttons {
    margin-right: 20px;
  }
}
.submitButton
{
    font-family: century gothic;
	text-align: center;
	text-decoration: none;
	font-size: 19;
    color: white;
    border: 2px solid #333;
	width: 120px;
	height: 30px;
    background: #333;
	float: right
}

.submitButton:hover {
  opacity: 0.7;
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
	<form class="searchBar" action="searchResults.php">
	<input type="text" placeholder="Search.." name="search"></form>
  <a href='log.php' class="right">Account</a>
  <a href="#" class="activeRight">Cart</a>
</div>




<form action="order.php" >

<div class="shopping-cart">
  <!-- Title -->
  <div class="title">
    Shopping Cart

	 <input type="submit"  class="submitButton" placeholder="Search" value='Order' name="Order">
	 </form>
  </div>
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
		
			openConnection();
			$query = "select * from products";
			$products = mysqli_query($connection, $query) or exit("Query: $query failed");
			$result = mysqli_query($connection, $query);
  
			if(isset($_GET['product']))
			{
				$value = $_GET['product'];
				$_SESSION['products'][] = $value;
			}
			
			if(isset($_GET['minusButton']))
			{
				
				if (($key = array_search($_GET['minusButton'], $_SESSION['products'])) !== false) {
					unset($_SESSION['products'][$key]);
}
			}

			while($row = mysqli_fetch_array($result))
				{	
					if(isset($_SESSION['products'])){
					if (in_array($row[0], $_SESSION['products'])) {
					
?>




  <div class="item">
    <div class="buttons">
      <span class="delete-btn"></span>
      <span class="like-btn"></span>
    </div>
 
    <div class="image">
	<?php
      echo "<img src=$row[7] height='100px' width='100px'/>";
	  ?>
    </div>
 
    <div class="description">
      <span><?php echo $row[1]; ?></span>
      <span><?php echo "in stock: " . $row[2]; ?></span>
      <span><?php echo $row[5]; ?></span>
    </div>
 
 
    <div class="quantity">
	
		
		<form onClick="location.href='cart.php?plusButton=<?php echo $row[0]; ?>'" style='float: left' method='get' class="plus-btn" value=<?php echo $row[0];?>  name="plusButton">
			<img src="images/plus.png" height="10px" width="10px" alt="" />
		</form >
		
      <input type="text" readonly name="<?php echo $row[1] . '_amount'; ?>" value="1">
	  
	  <form onClick="location.href='cart.php?minusButton=<?php echo $row[0]; ?>'" style='float: right' method='get' value='<?php echo $row[0];?>' class="minus-btn"  name="minusButton">
			<img src="images/minus.png" height="10px" width="10px" alt="" />
		</form >
	  
    </div>
 
 <input type="hidden" name="<?php echo $row[1]; ?>" type='get' value="<?php echo $row[7]; ?>" />
 
 <?php
	  if($row[6]>0)
	  {
		  $price = $row[3]-$row[6];
		  echo "<div class='total-price'>$price$</div>";
	  }
      else
	  {
		  echo "<div class='total-price'>$row[3]$</div>";
	  }
	  ?>
    
  </div>
 
<?php
				}		}}
		closeConnection();
?>

</div>
</body>
</html>
