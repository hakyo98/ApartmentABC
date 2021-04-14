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
</head>

<body>
<h1>Apartment ABC</h1>

<div>
<h2>Reset Password</h2>
<form class="loginout middle sign" action="reset_password.php" method="POST">
<!-----------------If the infomation is wrong----------------------->
<?php
if(isset($_GET['error'])){
echo "<h6 style='color: red; font-weight: none;'>Wrong information<h6>";
}
?>
	<input Class="sign" type="text" placeholder="Email" name="email" size="60" required> <br>
	<b>Birthday </b><input Class="sign"  type="date" placeholder="Enter your first name" name="sDOB" size="15" required>
	<input Class="sign" type="text" placeholder="NationalID No./Passport NO." name="national_id" size="25" required> <br>
    <input style="background-color: #52575D; color: #FDDB3A; width: 200px; font-size:20px;" type="submit" name="reset" value="Proceed to Reset"><br><br>
	<h3><a href="login.php">Back to login</a></h3>
</form>
</div>

</body>
</html>