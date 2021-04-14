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
<header class="bgimg-1 w3-display-container w3-grayscale-min" id="home">
<div style="text-align:center; background-color: #f6f7d4; margin-left:auto; margin-right:auto; padding:15px 0px 15px; ">
<?php
echo '<a href="3.1)book_map.php" class="button selected">Map & Availability</a>';
echo '<a href="3.2)book_reserve.php" class="button">Reservation</a>';
echo '<a href="3.3)booking_table.php" class="button">Table</a>';
?>
</div>

<div style="text-align:center; background-color: #F9F9F9;">
	<!--%%%%% Main block %%%%-->
	<form action="3.1)book_map.php" method="POST">
	<input Class="main" type="text" onchange='this.form.submit()' value="<?php if(isset($_POST['roomno'])){ echo $_POST['roomno'];} ?>" placeholder="Room no" name="roomno" size="10">
	<select id="status" name="status" onchange='this.form.submit()' style="width: fit-content;">
		<?php
			$arr = array("none","Available","Taken","Under Repair");
			foreach ($arr as &$value) {
			if(isset($_POST['status']) && $_POST['status']!="none" && $value==$_POST['status']){
				echo '<option value="'.$value.'" selected>'.$value.'</option>';
			}
			else{
				echo '<option value="'.$value.'" >'.$value.'</option>';
			}
			}
		?>
	</select>
	<select id="room_type" name="room_type" onchange='this.form.submit()' style="width: fit-content;">
		<?php
			if($_POST['room_rent']=="2,950-." || $_POST['room_rent']=="3,050-."){$arr = array("Standard");}
			elseif($_POST['room_rent']=="3,850-." || $_POST['room_rent']=="4,050-."){$arr = array("Premium");}
			elseif($_POST['room_rent']=="6,350-." || $_POST['room_rent']=="6,550-."){$arr = array("Paradise");}
			else{$arr = array("none","Standard","Premium","Paradise");}
			
			foreach ($arr as &$value) {
			if(isset($_POST['room_type']) && $_POST['room_type']!="none" && $value==$_POST['room_type']){
				echo '<option value="'.$value.'" selected>'.$value.'</option>';
			}
			else{
				echo '<option value="'.$value.'" >'.$value.'</option>';
			}
			}
		?>
	</select>
	<select id="room_rent" name="room_rent" onchange='this.form.submit()' style="width: fit-content;">
		<?php
			if($_POST['room_type']=="Standard"){$arr = array("none","2,950-.","3,050-.");}
			elseif($_POST['room_type']=="Premium"){$arr = array("none","3,850-.","4,050-.");}
			elseif($_POST['room_type']=="Paradise"){$arr = array("none","6,350-.","6,550-.");}
			else{$arr = array("none","2,950-.","3,050-.","3,850-.","4,050-.","6,350-.","6,550-.");}
			
			foreach ($arr as &$value) {
			if(isset($_POST['room_rent']) && $_POST['room_rent']!="none" && $value==$_POST['room_rent']){
				echo '<option value="'.$value.'" selected>'.$value.'</option>';
			}
			else{
				echo '<option value="'.$value.'" >'.$value.'</option>';
			}
			}
		?>
	</select>
	<noscript><input type="submit" value="search"></noscript>
  </form>
	
	<?php
		
	$q="select * from room_info";
	
	if(isset($_POST['room_type'])) {
	$roomno=$_POST['roomno'];
	$roomstatus=$_POST['status'];
	$room_type=$_POST['room_type'];
	$room_rent=$_POST['room_rent'];
	if($roomstatus=="none"){$roomstatus='';}
	if($room_rent=="2,950-."){
		$roomprice="AND building NOT like '%M%' AND building NOT like '%P%' AND floor='1'";
	}
	elseif($room_rent=="3,050-."){
		$roomprice="AND building NOT like '%M%' AND building NOT like '%P%' AND floor!='1'";
	}
	elseif($room_rent=="3,850-."){
		$roomprice="AND building like '%M%' AND floor='1'";
	}
	elseif($room_rent=="4,050-."){
		$roomprice="AND building like '%M%' AND floor!='1'";
	}
	elseif($room_rent=="6,350-."){
		$roomprice="AND building like '%P%' AND floor='1'";
	}
	elseif($room_rent=="6,550-."){
		$roomprice="AND building like '%P%' AND floor!='1'";
	}
	else{$roomprice='';}
		
	if($room_type=="Standard"){
		$roomtype="AND building NOT like '%M%' AND building NOT like '%P%'";
	}
	elseif($room_type=="Premium"){
		$roomtype="AND building like '%M%'";
	}
	elseif($room_type=="Paradise"){
		$roomtype="AND building like '%P%'";
	}
	else{$roomtype='';}	
	
	$q="select * from room_info where roomno like '%$roomno%'
	".$roomtype.$roomprice." and status like '%$roomstatus%'";
	
	$result=$mysqli->query($q);
	if(!$result){
		echo $mysqli->connect_errno.": ".$mysqli->connect_error;
	}
	}	
	?>
</div>
<div style="text-align: center; background-color: #F9F9F9;">
<?php
$i=1;
$result=$mysqli->query($q);
if(!$result){
	echo 'Query error: '.$mysqli->error;
}
$count=$result->num_rows;
if($count==0){$color1="#FF0000";}
else{$color1="#02D619";}
echo '<div style="padding: 0px 0px 15px; color:'.$color1.'">';
echo "Total $count records";
echo '</div>';
$result->free();
?>
<div style="padding-bottom: 2em;">
<table class="detail">
    <tr>
		<th>Roomno</th>
        <th>Status</th> 
		<th>Room type</th>
        <th>Room rent</th>
		<th></th>
    </tr>
<?php
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
        <td><?php echo $row['roomno'];?></td> 
		<?php
		if($row['status']=="Taken"){$status="#FF0000";}
		elseif($row['status']=="Available"){$status="#02D619";}
		else{$status="#A9A9A9";}
		?>
        <td style="color: <?php echo $status;?>;"><?php echo $row['status'];?></td>
        <td>
		<?php
		$standard = array(
		"A1","A2","A3","A4","A5","A6","A7",
		"B1","B2","B3","B4","B5","B6","B7",
		"C1",          "C4","C5","C6","C7");
		$Premium = array(
		"M1","M2");
		$Paradise = array(
		"P1");
		if(in_array($row['building'],$standard)){
			echo 'Standard';
			$price="2,950-.";
			if($row['floor']>1){
				$price="3,050-.";
			}
		}
		elseif(in_array($row['building'],$Premium)){
			echo 'Premium';
			$price="3,850-.";
			if($row['floor']>1){
				$price="4,050-.";
			}
		}
		elseif(in_array($row['building'],$Paradise)){
			echo 'Paradise';
			$price="6,350-.";
			if($row['floor']>1){
				$price="6,550-.";
			}
		}
		?>
		</td> 
        <td><?php echo $price;?></td> 
		<form action="3.2)book_reserve.php" method="post">
		<input type="hidden" name="building" value="<?php echo substr($row['roomno'],0,2);?>">
		<input type="hidden" name="floor" value="<?php echo substr($row['roomno'],2,1);?>">
		<input type="hidden" name="room" value="<?php echo substr($row['roomno'],3);?>">
		<td>
		<?php
		if($row['status']=="Available"){
		echo '<button class="open-button" name="Reserve_now">Reserve now</button>';}
		?>
		</td>
		</form>

	</tr>                               
<?php }?>
</table>
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
