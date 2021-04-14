<?php require_once('connect.php');
session_start();
if(!isset($_SESSION['staff_id'])){
header("location: http://localhost/P/Staff/login.php");
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Golf View Sign</title>
<link rel="icon" href="appartment.png">
<link href="homestyle.css" rel="stylesheet">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://kit.fontawesome.com/a076d05399.js"></script>
<link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&display=swap" rel="stylesheet">
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

<!-- Navbar (sit on top) -->
<div class="top">
  <div class="bar" id="myNavbar">
	<?php if($_SESSION['position']=="Head"){
		echo '<a href="homescreen.php" class="logo">'.$_SESSION["position"].' of '.$_SESSION["department"].'</a>';
	}
	elseif($_SESSION['position']=="Admin"){
		echo '<a href="homescreen.php" class="logo">'.$_SESSION["department"].'</a>';
	}
	else{
		echo '<a href="homescreen.php" class="logo"> '.$_SESSION["department"].' '.$_SESSION["position"].'</a>';  
	}
	?>
	<!-- Right-sided navbar links -->
    <div class="w3-right w3-hide-small" >
	<?php
	if($_SESSION['position']=="Head" || $_SESSION['department']=="Admin"){
		echo '<a href="1-1)staff-list.php"  class="button"> STAFF-LIST</a>';
		echo '<a href="2-1)add-staff.php" class="button selected"><i class="fa fa-plus"></i> ADD-STAFF</a>';
	}
	if($_SESSION['department']=="Admin"){
		echo '<a href="3.1)book_map.php" class="button"> <i class="fas fa-home"></i>  BOOKING</a>';
		echo '<a href="4)pricing.php" class="button"><i class="fa fa-usd"></i> PRICING</a>';
		echo '<a href="3.5)lease_input.php" class="button"><i class="fa fa-th"></i> LEASE</a>';
		echo '<a href="4.5)billing_input.php" class="button"><i class="fas fa-receipt"></i> BILLING</a>';
		echo '<a href="5)staff-maintenance_request.php" class="button"><i class="fas fa-wrench"></i> MAINTENANCE</a>';
		echo '<a href="6)staff-parcel_input.php" class="button"><i class="fas fa-shipping-fast"></i> PARCEL</a>';
	}
	elseif($_SESSION['department']=="Office"){
		echo '<a href="3.1)book_map.php" class="button"> <i class="fas fa-home"></i> BOOKING</a>';
		echo '<a href="4)pricing.php" class="button"><i class="fa fa-usd"></i> PRICING</a>';
		echo '<a href="3.5)lease_input.php" class="button"><i class="fa fa-th"></i> LEASE</a>';
	}
	elseif($_SESSION['department']=="Maintenance"){
		echo '<a href="4.5)billing_input.php" class="button"><i class="fas fa-receipt"></i>  BILLING</a>';
		echo '<a href="5)staff-maintenance_request.php" class="button"><i class="fas fa-wrench"></i> MAINTENANCE</a>';
	}
	elseif($_SESSION['department']=="Package"){
		echo '<a href="6)staff-parcel_input.php" class="button"><i class="fas fa-shipping-fast"></i> PARCEL</a>';
	}
	?>
      <a href="7)staff-profile.php"     class="button"><i class="fa fa-user-circle"></i></a>
	  <a href="login.php?logout=1" 		class="button"><i class="fas fa-sign-out-alt"></i></a>
    </div>
    <!-- Hide right-floated links on small screens and replace them with a menu icon -->
    <a href="javascript:void(0)" class="w3-bar-item w3-button w3-right w3-hide-large w3-hide-medium" onclick="w3_open()">
      <i class="fa fa-bars"></i>
    </a>
  </div>
</div>

<!-- Sidebar on small screens when clicking the menu icon -->
<nav class="w3-sidebar w3-bar-block w3-black w3-card w3-animate-left w3-hide-medium w3-hide-large" style="display:none" id="mySidebar">
  <a href="javascript:void(0)" onclick="w3_close()" class="w3-bar-item w3-button w3-large w3-padding-16">Close ×</a>
  <a href="" onclick="w3_close()" class="w3-bar-item w3-button">MEMBERS</a>
  <a href="" onclick="w3_close()" class="w3-bar-item w3-button">ADD-MEMBERS</a>
  <a href="" onclick="w3_close()" class="w3-bar-item w3-button">BOOK NOW</a>
  <a href="" onclick="w3_close()" class="w3-bar-item w3-button">WORK</a>
  <a href="" onclick="w3_close()" class="w3-bar-item w3-button">PRICING</a>
  <a href="" onclick="w3_close()" class="w3-bar-item w3-button">CONTACT US</a>
  <a href="" onclick="w3_close()" class="w3-bar-item w3-button">SIGN OUT</a>
</nav>

<!-- Header with full-height image -->
<header class="w3-display-container" id="home">
<body>

<div style="text-align:center;">
<h2 style="padding:25px 0px 20px; margin:0px; background-color: #F9F9F9;">Sign up</h2>

  <form style="text-align:center; background-color: #F9F9F9;" action="1-1)staff-list.php" method="POST">
        <select name="title" style="width: fit-content;">
			<option value="Mr.">Mr.</option>
	  		<option value="Mrs.">Mrs.</option>
	  		<option value="Miss">Miss</option>
	    </select>
		<input Class="sign" type="text" placeholder="Enter your first name" name="sfname" size="20" required>
        <input Class="sign" type="text" placeholder="Enter your last name" name="slname" size="20" required>
        <input Class="sign" type="text" placeholder="Enter your middle name" name="smname" size="20"> <br>
        <b>Birthday </b><input Class="sign"  type="date" name="sDOB" size="15" required>
        <b>Enroll date </b><input Class="sign"  type="date" name="enroll_date" size="15" required>
        <input Class="sign" type="text" placeholder="NationalID No./Passport NO." name="idpassport" size="25" required> <br>
        <input Class="sign" type="text" placeholder="Address" name="address" size="60%" required>
	    <input Class="sign" type="text" placeholder="Email" name="email" size="25" required><br>
        <label for="Civil">Civil status</label>	
		<select id="Civil" name="civil_status" style="width: fit-content;">
			<option value="Single">Single</option>
	  		<option value="Married">Married</option>
	  		<option value="Divorced">Divorced</option>
	  		<option value="Widowed">Widowed</option>
	    </select>
		<label for="depart">Department</label>	
		<select id="depart" name="department" style="width: fit-content;">
			<option value="Office">Office</option>
	  		<option value="Maintenance">Maintenance</option>
	  		<option value="Package">Package</option>
	    </select>
        <label for="posit">Position</label>	
		<select id="posit" name="position" style="width: fit-content;">
			<option value="Staff">Staff</option>
	  		<option value="Head">Head</option>
	    </select>
		<input Class="sign" type="text" placeholder="Salary" name="salary" size="6" required> 
        <input Class="sign" type="text" placeholder="Telephone" name="telephone" size="10" required><br>
	    <input Class="sign" type="text" placeholder="Languages ability" name="language_ability" size="13" required>
  	    <input Class="sign" type="password" placeholder="Password" name="passwd" size="25" required>
        <input Class="sign" type="password" placeholder="*Confirm Password" name="cpasswd" size="25" required><br>
        all fields above are required* <br><br>
	    <input class="button1" type="submit" name="submit" value="Sign Up"><br>
  </form>
</div>


</body>
</header>

</body>
</html>
