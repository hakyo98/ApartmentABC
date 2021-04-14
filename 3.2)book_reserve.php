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
		echo '<a href="2-1)add-staff.php" class="button"><i class="fa fa-plus"></i> ADD-STAFF</a>';
	}
	if($_SESSION['department']=="Admin"){
		echo '<a href="3.1)book_map.php" class="button selected"> <i class="fas fa-home"></i>  BOOKING</a>';
		echo '<a href="4)pricing.php" class="button"><i class="fa fa-usd"></i> PRICING</a>';
		echo '<a href="3.5)lease_input.php" class="button"><i class="fa fa-th"></i> LEASE</a>';
		echo '<a href="4.5)billing_input.php" class="button"><i class="fas fa-receipt"></i> BILLING</a>';
		echo '<a href="5)staff-maintenance_request.php" class="button"><i class="fas fa-wrench"></i> MAINTENANCE</a>';
		echo '<a href="6)staff-parcel_input.php" class="button"><i class="fas fa-shipping-fast"></i> PARCEL</a>';
	}
	elseif($_SESSION['department']=="Office"){
		echo '<a href="3.1)book_map.php" class="button selected"> <i class="fas fa-home"></i> BOOKING</a>';
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
<div style="text-align:center; background-color: #f6f7d4; margin-left:auto; margin-right:auto; padding:15px 0px 15px; ">
<?php
echo '<a href="3.1)book_map.php" class="button">Map & Availability</a>';
echo '<a href="3.2)book_reserve.php" class="button selected">Reservation</a>';
echo '<a href="3.3)booking_table.php" class="button">Table</a>';
?>
</div>

<div style="text-align:center; background-color: #F9F9F9; margin: auto;">
<h2 style="padding: 25px 0px 0px; margin:0px;">Reserve what you Deserve</h2>
	<form id="roombook" action="3.2)book_reserve.php" method="post">
		<?php
		if(isset($_POST['building'])){$building=$_POST['building'];}
		else{$building='';}
		if(isset($_POST['floor'])){$floor=$_POST['floor'];}
		else{$floor='';}
		if(isset($_POST['room'])){$room=$_POST['room'];}
		else{$room='';}
		if(isset($_POST['user_id'])){$user_id=$_POST['user_id'];}
		else{$user_id='';}
		?>
		<input Class="main" onchange='this.form.submit()' type="text" placeholder="User ID" value="<?php echo $user_id;?>" name="user_id" size="7" required>
		<label>Building:</label>
		<select  name="building" onchange='this.form.submit()' style="width: fit-content;">
		<?php
		if(isset($_POST['building']) && $_POST['building']!=''){
			echo '<option value="'.$_POST['building'].'" selected>'.$_POST['building'].'</option>';
		}else{
			echo '<option value="" selected> none </option>';
		}
		$q="select distinct building FROM room_info WHERE floor like '%$floor%' AND
		roomno like '%$room' AND status='available' ORDER BY building";
		$result=$mysqli->query($q);
		while($row=$result->fetch_array()){
			if($row['building']!=$building){
			echo '<option value="'.$row['building'].'" >'.$row['building'].'</option>';}}
		$result->free();
		?>
		</select>
		<label>Floor:</label>
		<select  name="floor" onchange='this.form.submit()' style="width: fit-content;">
		<?php
		if(isset($_POST['floor']) && $_POST['floor']!=''){
			echo '<option value="'.$_POST['floor'].'" selected>'.$_POST['floor'].'</option>';
		}else{
			echo '<option value="" selected> none </option>';
		}
		$q="select distinct floor FROM room_info WHERE building like '%$building%' AND
		roomno like '%$room' AND status='available' ORDER BY floor";
		$result=$mysqli->query($q);
		while($row=$result->fetch_array()){
			if($row['floor']!=$floor){
			echo '<option value="'.$row['floor'].'" >'.$row['floor'].'</option>';}}
		$result->free();
		?>
		</select>
		
		<label>Room:</label>
		<select  name="room" onchange='this.form.submit()' style="width: fit-content;">
		<?php
		if(isset($_POST['room']) && $_POST['room']!=''){
			echo '<option value="'.$_POST['room'].'" selected>'.$_POST['room'].'</option>';
		}else{
			echo '<option value="" selected> none </option>';
		}
		$q="SELECT DISTINCT RIGHT(roomno, 2)as roomno FROM room_info WHERE building like '%$building%' AND
		floor like '%$floor%' AND status='available' ORDER BY roomno";
		$result=$mysqli->query($q);
		while($row=$result->fetch_array()){
			if($row['roomno']!=$room){
			echo '<option value="'.$row['roomno'].'" >'.$row['roomno'].'</option>';}}
		$result->free();
		?>
		</select>
		<noscript><input type="submit" value="Submit"></noscript>
	</form>
		
<form style="text-align:center; background-color: #F9F9F9;" action="3.2)book_reserve.php" method="POST">
<?php

$title='';
$fname='';
$mname='';
$lname='';
$DOB='';
$national_id='';
$telephone='';
$address='';
$email='';
$roomtype='';
$price='';

if(isset($_POST['building'])){
	
if($user_id!=''){
$user_id=$_POST['user_id'];
$q="select * FROM user WHERE user_id = '$user_id'";
$result=$mysqli->query($q);
$row=$result->fetch_array();

$title=$row['title'];
$fname=$row['fname'];
$mname=$row['mname'];
$lname=$row['lname'];
$DOB=$row['DOB'];
$national_id=$row['national_id'];
$telephone=$row['telephone'];
$address=$row['address'];
$email=$row['email'];
}
	
$standard = array(
"A1","A2","A3","A4","A5","A6","A7",
"B1","B2","B3","B4","B5","B6","B7",
"C1",          "C4","C5","C6","C7");
$Premium = array(
"M1","M2");
$Paradise = array(
"P1");
if(in_array($_POST['building'],$standard)){
	$roomtype='Standard';
	$price="2,950-.";
	if($_POST['floor']>1){
		$price="3,050-.";
	}
}
elseif(in_array($_POST['building'],$Premium)){
	$roomtype='Premium';
	$price="3,850-.";
	if($_POST['floor']>1){
		$price="4,050-.";
	}
}
elseif(in_array($_POST['building'],$Paradise)){
	$roomtype='Paradise';
	$price="6,350-.";
	if($_POST['floor']>1){
		$price="6,550-.";
	}
}
}

?><br>
      <label>Room Number:</label>
	  <?php echo $building.$floor.$room;?><br>
	  <?php echo $roomtype."      ";?>
	  <label>Price:</label>
	  <?php echo $price;?> <br>
	  <b>Appoitment date</b><input Class="main"  type="date" name="appoitment_date" value="<?php echo date('Y-m-d');?>" name="dateom" >
	  <br> <label>User ID:</label>
	  <?php echo $user_id;?>
	  <label>Name: </label>
	  <?php echo $title;?> <?php echo $fname;?> <?php echo $mname;?> <?php echo $lname;?>
	  <br><br>
	  <label>Birthday</label>
	  <?php echo $DOB;?>
	  <label>NationalID/Passport NO.</label>
	  <?php echo $national_id;?>
	  <label>Telephone</label>
	  <?php echo $telephone;?>
	  <br><br>
	  <label>Address</label>
	  <?php echo $address;?>
	  <label>Email</label>
	  <?php echo $email;?>   
	  <br><br>
      all fields above are required* <br>
	  <input type="hidden" name="user_id" value="<?php echo $user_id;?>"><br>
	  <input type="hidden" name="roomno" value="<?php echo $building.$floor.$room;?>"><br>
	  <input class="button1" type="submit" name="book_now" value="Book Now!"><br>

  </form>
</div>
<div style="text-align: center; background-color: #F9F9F9;">
<?php	
	if(isset($_POST['book_now'])) {
	$user_id=$_POST['user_id'];
	$roomno=$_POST['roomno'];
	$appointment_date=$_POST['appoitment_date'];

	$q="INSERT INTO booking (booking_id,user_id,roomno,appointment_date)
		VALUES ('','$user_id','$roomno','$appointment_date')";
	$result=$mysqli->query($q);
	if(!$result){
		echo $mysqli->connect_errno.": ".$mysqli->connect_error;
	}
	$user_id='';
	$_POST['user_id']='';
	}
?>

</div>
</div>
<script>
function Change(){
 document.getElementById('roombook').submit();
}
</script>
</header>
</body>
</html>
