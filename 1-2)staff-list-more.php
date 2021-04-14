<?php require_once('connect.php');
session_start();
if(!isset($_SESSION['staff_id'])){
header("location: http://localhost/P/Staff/login.php");
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Staff Member Profile</title>
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
		echo '<a href="1-1)staff-list.php"  class="button selected"> STAFF-LIST</a>';
		echo '<a href="2-1)add-staff.php" class="button"><i class="fa fa-plus"></i> ADD-STAFF</a>';
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
<?php
$staff_id = $_GET['userid'];
$q="select * from staff where staff_id=$staff_id";
$result=$mysqli->query($q);
if(!$result){
	echo 'Query error: '.$mysqli->error;
}
$row=$result->fetch_array();
?>
<div style="background-color: #F9F9F9;">
<h2 style="text-align:center; padding:25px 0px 20px; margin:0px; ">Staff Member Profile</h2>
<div class="grid-container" style="padding: 0px 30px;">
	<div class="grid-item" style="text-align: center;">
	<?php 
	$resul = $mysqli->query("SELECT image FROM staff_profile_images WHERE staff_id='$staff_id'"); 
	if($resul->num_rows > 0){ ?> 
        <?php while($ro = $resul->fetch_assoc()){ 
            echo '<img style="width:100%;" src="data:image/jpg;charset=utf8;base64,'.base64_encode($ro['image']).'"/>';
         } ?> 
    
	<?php }else{ 
	echo "<img style='width:100%;'  src='images\profile.png' alt='photo of staff'/>";
	}
	?>

	<h5><?php echo $row['title'];?> <?php echo $row['sfname'];?> <?php echo $row['smname'];?> <?php echo $row['slname'];?></h5>
	</div>
	<div class="grid-item" style="padding: 0px 30px;">
	<div class="grid-container">	                                                                                                                              
		<div class="grid-item"><b>Department</b>			</div><div class="grid-item"><h6>	<?php echo $row['department'];?>  			</h6><br></div>
		<div class="grid-item"><b>Position</b>				</div><div class="grid-item"><h6>	<?php echo $row['position'];?>  			</h6><br></div>
		<div class="grid-item"><b>Telephone</b>				</div><div class="grid-item"><h6>	<?php echo "(0) "; echo $row['telephone'];?></h6><br></div>
		<div class="grid-item"><b>NationalID/Passport</b>	</div><div class="grid-item"><h6>	<?php echo $row['national_id'];?>			</h6><br></div>
		<div class="grid-item"><b>Email</b>					</div><div class="grid-item"><h6>	<?php echo $row['email'];?>					</h6><br></div>
		<div class="grid-item"><b>Enroll date</b>			</div><div class="grid-item"><h6>	<?php echo $row['enroll_date'];?>			</h6><br></div>
		<div class="grid-item"><b>Salary</b>				</div><div class="grid-item"><h6>	<?php echo $row['salary'];?> 				</h6><br></div>
		<div class="grid-item"><b>Birthday</b>    			</div><div class="grid-item"><h6>	<?php echo $row['sDOB'];?>					</h6><br></div>
		<div class="grid-item"><b>Civil Status</b> 			</div><div class="grid-item"><h6>	<?php echo $row['civil_status'];?>			</h6><br></div>
		<div class="grid-item"><b>Address </b>				</div><div class="grid-item"><h6>	<?php echo $row['address'];?>				</h6><br></div>
		<div class="grid-item"><b>Languages Ability</b>		</div><div class="grid-item"><h6>	<?php echo $row['language_ability'];?>		</h6><br></div>

</div>
</div>
</div>
</div>


</body>
</header>

</html>