<?php
session_start();
 
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: account.php");
    exit;
}

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

function safeLog1() {
	global $connection;
	$login = $_POST['login'];
    $password = $_POST['password'];
    
	openConnection();
	$stmt = mysqli_prepare($connection, "select * from users where login=? and password=?");
	mysqli_stmt_bind_param($stmt, 'ss', $login, $password);
	mysqli_stmt_execute($stmt);	
	
	$users = mysqli_stmt_get_result($stmt);
		
	if($user = mysqli_fetch_array($users))  { 		   
		$_SESSION["loggedin"] = true;  
		$_SESSION["user"] = $user[0];	
		 header("location: account.php");
	}
	else echo "Sorry, login failed.";
	
	mysqli_stmt_free_result($stmt);
	mysqli_stmt_close ($stmt);
	closeConnection();
}
?>
<html>
<head>
<link href="style.css" rel="stylesheet" type="text/css">
  <meta charset="utf-8">
  <title>Log in</title>
  <style> input[type='text'] { text-align: left } 
  
  .container {
    position: absolute;
    top: 40%;
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
  <a href='mainPage.php'>Home</a>
  <a href="contact.php">Contact</a>
  <a href="author.php">Author</a>
  <input type="text" placeholder="Search.." name="search">
  <a href='log.php' class="activeRight" >Account</a>
  <a href="cart.php" class="right">Cart</a>
</div>

<body style='background: white; color: black'> 
<div class="container">

<br><center>

<?php
if(isset($_POST['login'])) {
	safeLog1();
}
else { 
?>

<form method=POST action=''> 
<table border=0>
<tr>
<td>Login:</td><td colspan=2><input type=text name='login' size=15></td>
</tr>
<tr>
<td>Password:</td><td colspan=2>
<input type=password name='password' size=15></td>
</tr>
<tr>
<td colspan=3><input type=submit value='Log in' style='width:200'></td>
</tr>
</table>
</form>

If you have no account, please <a href='registration.php'>REGISTER</a>
<?php }?>
</center>
</body>
</div>
</html>
