<?php
require_once('connect.php'); 
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-10">
    <title>Apartment ABC Login</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="icon" href="appartment.png">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@1,600&family=Sacramento&family=Sriracha&display=swap" rel="stylesheet">
		<script src="https://kit.fontawesome.com/a076d05399.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
	<script src="sweetalert2.all.min.js"></script>
</head>

<body>

<h1>Apartment ABC</h1>

<?php
if(isset($_POST['reset'])){
	$spassword=$_POST['spassword'];
	$spassword=md5($spassword);
	$staff_id=$_POST['staff_id'];
	$q="UPDATE staff SET spassword='$spassword' WHERE staff_id='$staff_id'";
	$result = $mysqli->query($q); 
	if($result){
	?>
<script>
Swal.fire(
  'Successfully reseted',
  '',
  'success'
)
</script>
<?php
	}
}
?>

<div>
<h2>Login</h2>

<?php

unset($_SESSION['staff_id']);
unset($_SESSION['department']);
unset($_SESSION['position']);
unset($_SESSION['email']);
unset($_SESSION['passwd']);

if(isset($_GET['error'])){
echo "<h4 style='color: red;'>Incorrect username or password<h4>";
}
?>
  <form class="loginout" action="logincheck.php" method="POST">
  		<input placeholder="Email" type="text" name="email" id="title" size="30" > <br>
  		<input placeholder="Password" type="password" name="passwd" cols="15" rows="1" >
	<h3><a href="reset.php">Reset password</a></h3><br>
		<input style="background-color: #52575D; color: #FDDB3A; width: 200px; font-size:20px;" type="submit" name="submit" value="Login"><br><br>
  </form>
</div>

</body>
</html>