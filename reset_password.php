<?php
require_once('connect.php'); 
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-10">
    <title>Golf View Login</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="icon" href="appartment.png">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@1,600&family=Sacramento&family=Sriracha&display=swap" rel="stylesheet">
</head>

<body>

<!-------------- check if the info match ------------------>
<?php
if(isset($_POST['reset'])){
	$email=$_POST['email'];
	$sDOB=$_POST['sDOB'];
	$national_id=$_POST['national_id'];
	$q="SELECT * FROM staff WHERE email='$email' AND sDOB='$sDOB' AND national_id='$national_id'";
	$result = $mysqli->query($q);
if($result->num_rows > 0){
	$row=$result->fetch_array();
}else{
	header("location: http://localhost/P/Staff/reset.php?error=1");
}
}else{header("location: http://localhost/P/Staff/reset.php");}
?>	

<h1>Golf View</h1>

<div>
<h2>Reset Password</h2>
<form class="loginout middle sign" action="login.php" method="POST">
	<input Class="sign" type="text" placeholder="Password" name="spassword" size="60" required> <br>
	<input Class="sign" type="text" placeholder="Confirm password" name="scpassword" size="60" required> <br>
	<input type="hidden" name="staff_id" value="<?php echo $row['staff_id']?>">
    <input style="background-color: #52575D; color: #FDDB3A; width: 200px; font-size:20px;" class="btn" type="submit" name="reset" value="Reset"><br><br>
	<h3><a href="login.php">Back to login</a></h3>
</form>
</div>

</body>
</html>
