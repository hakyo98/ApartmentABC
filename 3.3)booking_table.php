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
<script src="http://code.jquery.com/jquery-latest.min.js"></script>
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

<!-- Pop up receipt -->
<div
<?php
if(isset($_POST['upload'])){echo "style='display: block; width: 500px; margin-left: 500px; margin-top: -80px;'";}
?>
class="form-popup" id="myForm">

<form action="3.3)booking_table.php" class="form-container" method="POST">
	<h3>Receipt</h3>
	<input style="background: green; text-align: center; width:49%;" class="btn" type="submit" name="confirm_booking" value="Confirm booking" onclick="myFunction()">
	<input style="background: red; text-align: center; width:49%;" class="btn" type="submit" name="reject_booking" value="Reject booking" onclick="myFunction()">
	<?php 
	$booking_id=$_POST['booking_id'];
	$resul = $mysqli->query("SELECT image FROM booking_payment_images WHERE booking_id='$booking_id'"); 
	if($resul->num_rows > 0){
		while($ro = $resul->fetch_assoc()){ 
        echo '<img style="width:100%" src="data:image/jpg;charset=utf8;base64,'.base64_encode($ro['image']).'"/>';
	}} ?>
	<div>
	<br>
	<input type="hidden" name="booking_id" value="<?php echo $booking_id;?>">
	</div>
  </form>
</div>

<!-- Update payment status -->
<?php
if(isset($_POST['confirm_booking'])){
$booking_id=$_POST['booking_id'];
$resul = $mysqli->query("UPDATE booking SET payment='Paid' WHERE booking_id='$booking_id'"); 
}
if(isset($_POST['reject_booking'])){
$booking_id=$_POST['booking_id'];
$resul = $mysqli->query("DELETE FROM booking_payment_images WHERE booking_id='$booking_id'"); 
$resul = $mysqli->query("DELETE FROM booking WHERE booking_id='$booking_id'"); 
}
?>

<!-- Header with full-height image -->
<header class="w3-display-container" id="home">
<div style="text-align:center; background-color: #f6f7d4; margin-left:auto; margin-right:auto; padding:15px 0px 15px; ">
<?php
echo '<a href="3.1)book_map.php" class="button">Map & Availability</a>';
echo '<a href="3.2)book_reserve.php" class="button">Reservation</a>';
echo '<a href="3.3)booking_table.php" class="button selected">Table</a>';
?>
</div>

<!-- Popup background -->
<div
<?php 
if(isset($_POST['upload'])){echo "style='display: block;'";}
?>
class="form-popup-background" onclick="closeForm();" id="myFormbackground">
</div>

<div style="text-align: center; background-color: #F9F9F9;">
<?php	
	if(isset($_POST['book_now'])) {
	$user_id=$_SESSION['user_id'];
	$roomno=$_POST['roomno'];
	$appointment_date=$_POST['appoitment_date'];
	echo $user_id;
	echo $roomno;
	echo $appointment_date;
	
	$q="INSERT INTO booking (booking_id,user_id,roomno,appointment_date)
		VALUES ('','$user_id','$roomno','$appointment_date')";
	$result=$mysqli->query($q);
	if(!$result){
		echo $mysqli->connect_errno.": ".$mysqli->connect_error;
	}
	}
?>

<div style="padding-bottom: 2em;">
<table class="detail">
    <tr>
		<th>ID</th>
        <th>User ID</th> 
		<th>roomno</th>
		<th>Building</th>
		<th>Room type</th>
		<th>Price</th>
        <th>Appoitment date</th>
		<th>Payment</th>
        <th>Receipt</th>
    </tr>
	
	<?php
	$q="select * from booking";
	$i=1;
	$result=$mysqli->query($q);
	if(!$result){
		echo 'Query error: '.$mysqli->error;
	}
	while($row=$result->fetch_array()){
		if($i==1)
		{
			$color="#F9F9F9";
			$i=-1;
		}
		else
		{
			$color="#D5D5D5";
			$i=1;
		}
	?>
     <tr style="background-color: <?php echo $color;?>;">
        <td><?php echo $row['booking_id'];?></td> 
        <td><?php echo $row['user_id'];?></td> 
        <td><?php echo $row['roomno'];?></td>
		
		<?php
		$standard = array(
		"A1","A2","A3","A4","A5","A6","A7",
		"B1","B2","B3","B4","B5","B6","B7",
		"C1",          "C4","C5","C6","C7");
		$Premium = array(
		"M1","M2");
		$Paradise = array(
		"P1");
		if(in_array(substr($row['roomno'],0,2),$standard)){
			$roomtype='Standard';
			$price="2,950-.";
			if(substr($row['roomno'],2,1)>1){
				$price="3,050-.";
			}
		}
		elseif(in_array(substr($row['roomno'],0,2),$Premium)){
			$roomtype='Premium';
			$price="3,850-.";
			if(substr($row['roomno'],2,1)>1){
				$price="4,050-.";
			}
		}
		elseif(in_array(substr($row['roomno'],0,2),$Paradise)){
			$roomtype='Paradise';
			$price="6,350-.";
			if(substr($row['roomno'],2,1)>1){
				$price="6,550-.";
			}
		}
		?>
        <td><?php echo substr($row['roomno'],0,2);?></td> 
        <td><?php echo $roomtype;?></td> 
        <td><?php echo $price;?></td> 
        <td><?php echo $row['appointment_date'];?></td> 
		<?php
		if($row['payment']=="Not paid"){$payment="#FF0000";}
		else{$payment="#02D619";}
		?>
        <td style="color: <?php echo $payment;?>;"><?php echo $row['payment'];?></td>
		
		<?php
		$booking_id=$row['booking_id'];
		$resul = $mysqli->query("SELECT image FROM booking_payment_images WHERE booking_id='$booking_id'"); 
		if($resul->num_rows > 0){
			$upload="Uploaded";
			$upload_color="#02D619";
		}
		else{
			$upload="None";
			$upload_color="#FF0000";
		}
		?>
		<form action="3.3)booking_table.php" method="post">
		<input type="hidden" name="booking_id" value="<?php echo $row['booking_id'];?>">
		<td><button style="background-color: <?php echo $upload_color;?>;" class="open-button" name="upload" value="upload"><?php echo $upload;?></button></td>
		</form>
	</tr>                               
<?php }?>
</table>
</div>
</div>
</header>
<script>
$(window).scroll(function() {
  $("#myForm").css({"margin-top": ($(window).scrollTop()-80) + "px", "margin-left":($(window).scrollLeft()+500) + "px"});

  sessionStorage.scrollTop = $(this).scrollTop();
});

$(document).ready(function() {
  if (sessionStorage.scrollTop != "undefined") {
    $(window).scrollTop(sessionStorage.scrollTop);
  }
});

function myFunction() {
	$("form").submit();
  if(!confirm("Are you sure?")){
	  event.preventDefault();
  }
}

function openForm() {
  document.getElementById("myForm").style.display = "block";
  document.getElementById("myFormbackground").style.display = "block";
}

function closeForm() {
  document.getElementById("myForm").style.display = "none";
  document.getElementById("myFormbackground").style.display = "none";
}
</script>
</body>
</html>
