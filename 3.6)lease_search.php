<?php require_once('connect.php');
session_start();
if(!isset($_SESSION['staff_id'])){
header("location: http://localhost/P/Staff/login.php");
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Homepage</title>
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
		echo '<a href="3.1)book_map.php" class="button"> <i class="fas fa-home"></i>  BOOKING</a>';
		echo '<a href="4)pricing.php" class="button"><i class="fa fa-usd"></i> PRICING</a>';
		echo '<a href="3.5)lease_input.php" class="button selected"><i class="fa fa-th"></i> LEASE</a>';
		echo '<a href="4.5)billing_input.php" class="button"><i class="fas fa-receipt"></i> BILLING</a>';
		echo '<a href="5)staff-maintenance_request.php" class="button"><i class="fas fa-wrench"></i> MAINTENANCE</a>';
		echo '<a href="6)staff-parcel_input.php" class="button"><i class="fas fa-shipping-fast"></i> PARCEL</a>';
	}
	elseif($_SESSION['department']=="Office"){
		echo '<a href="3.1)book_map.php" class="button"> <i class="fas fa-home"></i> BOOKING</a>';
		echo '<a href="4)pricing.php" class="button"><i class="fa fa-usd"></i> PRICING</a>';
		echo '<a href="3.5)lease_input.php" class="button selected"><i class="fa fa-th"></i> LEASE</a>';
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
  <a href="javascript:void(0)" onclick="w3_close()" class="w3-bar-item w3-button w3-large w3-padding-16">Close ??</a>
  <a href="" onclick="w3_close()" class="w3-bar-item w3-button">MEMBERS</a>
  <a href="" onclick="w3_close()" class="w3-bar-item w3-button">ADD-MEMBERS</a>
  <a href="" onclick="w3_close()" class="w3-bar-item w3-button">BOOK NOW</a>
  <a href="" onclick="w3_close()" class="w3-bar-item w3-button">WORK</a>
  <a href="" onclick="w3_close()" class="w3-bar-item w3-button">PRICING</a>
  <a href="" onclick="w3_close()" class="w3-bar-item w3-button">CONTACT US</a>
  <a href="" onclick="w3_close()" class="w3-bar-item w3-button">SIGN OUT</a>
</nav>

<!-- Pop up form -->
<?php
if(isset($_POST['edit'])){
$Lease_id=$_POST['Lease_id'];
$q="select * from lease where Lease_id=$Lease_id";
if($result=$mysqli->query($q)){
	$row=$result->fetch_array();
}else{
	echo "Query failed: ".$mysqli->error;
}
}
?>

<div
<?php
if(isset($_POST['edit'])){echo "style='display: block; margin-left: 220px; margin-top: 140px;'";}
?>
class="form-popup" id="myForm">

<form action="update_lease.php" class="form-container" method="POST">
<h1>Update</h1>

<b>Lease ID  <?php echo $Lease_id;?></b>
<input Class="main" type="text" value="<?php echo $row['roomno'];?>" name="roomno" size="7" required>
<?php
	$orgDate = $row['start_date'];
	$newDate = date("Y-m-d", strtotime($orgDate)); 
?>	
<b>Start date</b><input Class="main"  type="date" value="<?php echo $newDate;?>" name="start_date" required>
<?php
	$orgDate = $row['termination_date'];
	$newDate = date("Y-m-d", strtotime($orgDate)); 
?>	
<b>Termination date</b><input Class="main"  type="date" value="<?php echo $newDate;?>" name="termination_date">
<select name="period" style="width: fit-content;">
	<?php
	$i=0;
	$arr = array("3","6","12");
	$arr2 = array("3 months","6 months","12 months");
	foreach ($arr as &$value) {
	if($value==$row['period']){
		echo '<option value="'.$value.'" selected>'.$arr2[$i].'</option>';
	}
	else{
		echo '<option value="'.$value.'" >'.$arr2[$i].'</option>';
	}
	$i++;
	}
	?>
</select>
<input type="hidden" name="user_id" value="<?php echo $row['user_id']?>">
<input type="hidden" name="lease_id" value="<?php echo $row['Lease_id']?>">
<input type="hidden" name="page" value="search">
<div>
<input style="margin-right:21vmax; margin-left:21vmax;" class="btn" type="submit" name="deactivate" value="Deactivate" onclick="myFunction()">
<input style="background: green;" class="btn" type="submit" name="update" value="Update">
</div>
</form>
</div>

<!-- Header with full-height image -->
<header class="w3-display-container" id="home">
<hr style="margin:-1px; padding:0px;  border-top: 2px solid #838383;">
<div class="types">
<?php
echo '<a href="3.5)lease_input.php" class="button">Input</a>';
echo '<a href="3.6)lease_search.php" class="button selected">Search</a>';
?>
</div>

<!--%%%%% Form for Request %%%%-->
<div style="text-align:center; background-color: #F9F9F9; margin: auto;">
<h2 style="padding: 10px 0px 10px; margin:0px;">Input lease</h2>
  <form action="3.6)lease_search.php" method="POST">
      <input Class="main" type="text" placeholder="Lease ID" name="Lease_id" size="7">
      <input Class="main" type="text" placeholder="User ID" name="user_id" size="7">
	  <input Class="main" type="text" placeholder="Name" name="name" size="7">
      <input Class="main" type="text" placeholder="Room No" name="roomno" size="7">
      <b>Start date</b><input Class="main"  type="date" name="start_date">
      <b>Termination date</b><input Class="main"  type="date" name="termination_date">
	    <select name="period" style="width: fit-content;">
			<option value="">period</option>
			<option value="3">3 months</option>
			<option value="6">6 months</option>
			<option value="12">12 months</option>
		</select>
		<select name="status" style="width: fit-content;">
			<option value="">Status</option>
			<option value="Active">Active</option>
			<option value="Inactive">Inaction</option>
		</select>
	  <input class="btn" type="submit" name="search" value="Search"><br>
  </form>
</div>

<!-- Popup form background -->
<div 
<?php 
if(isset($_POST['edit'])){echo "style='display: block;'";}
?>
class="form-popup-background" onclick="closeForm(); close();" id="myFormbackground">
</div>



<div style=" background-color: #F9F9F9;">
<!--%%%%% Main block %%%%-->
<?php 
$q="SELECT
	lease.Lease_id,
    lease.member_id as lease_member_id,
    lease.roomno,
    lease.start_date,
    lease.termination_date,
    lease.period,
    lease.status,
    room_info.member_id,
    member.user_id,
    user.fname,
    user.lname,
    user.telephone
FROM
    lease
INNER JOIN room_info ON lease.roomno=room_info.roomno
INNER JOIN member ON lease.member_id=member.member_id
INNER JOIN user ON member.user_id=user.user_id
ORDER BY lease.Lease_id DESC
    ";

if(isset($_POST['search'])) {
	// search data in lease
	$Lease_id=$_POST['Lease_id'];
	$user_id=$_POST['user_id'];
	$roomno=$_POST['roomno'];
	$name = explode(" ", $_POST['name']);
	$fname = $name[0];
	if(isset($name[1])){$lname = $name[1];}else{$lname = "";}
	$start_date=$_POST['start_date'];
	$termination_date=$_POST['termination_date'];
	$period=$_POST['period'];
	$status=$_POST['status'];
	
$q="SELECT
	lease.Lease_id,
    lease.member_id as lease_member_id,
    lease.roomno,
    lease.start_date,
    lease.termination_date,
    lease.period,
    lease.status,
    room_info.member_id,
    member.user_id,
    user.fname,
    user.lname,
    user.telephone
FROM
    lease
INNER JOIN room_info ON lease.roomno=room_info.roomno
INNER JOIN member ON lease.member_id=member.member_id
INNER JOIN user ON member.user_id=user.user_id

WHERE lease.Lease_id like '%$Lease_id%' and lease.roomno like '%$roomno%' and lease.start_date like '%$start_date%'
	and lease.termination_date like '%$termination_date%' and lease.period like '%$period%' and lease.status like '$status%'
	and member.user_id like '%$user_id%'
	and ((user.fname like '%$fname%' and user.lname like '%$lname%') or (user.fname like '%$lname%' and user.lname like '%$fname%'))
ORDER BY lease.Lease_id DESC
    ";
}

if($result=$mysqli->query($q)){
	$count=$result->num_rows;
	if($count==0){$color1="#FF0000";}
	else{$color1="#02D619";}
?>
<div style="padding: 0px 0px 10px; text-align: center; color: <?php echo $color1;?>;">
<?php
	echo "Total $count records";
	echo '</div>';
}else{
	echo "Query failed: ".$mysqli->error;
}
?>
<div style="text-align: center;  padding-bottom: 30px;">
	<table class="detail">
        <tr>
			<th>Lease ID</th>
            <th>User ID</th>
            <th>Member ID</th>
            <th>Name</th>
			<th>roomno</th>
            <th>Start date<br>(yyyy-mm-dd)</th>
			<th>End date<br>(yyyy-mm-dd)</th>
			<th>Termination date<br>(yyyy-mm-dd)</th>
			<th>Period</th>
			<th>Status</th>
        </tr> 
		
		<?php
		$i=1;
		while($row=$result->fetch_array()){ 
			if($i==1){
				$color="#F9F9F9";
				$i=-1;}
			else{
				$color="#D5D5D5";
				$i=1;}
		?>

         <tr style="padding:5px; background-color: <?php echo $color;?>;">
            <td><?php echo $row['Lease_id'];?></td>
            <td><?php echo $row['user_id'];?></td>
            <td><?php echo $row['lease_member_id'];?></td>
            <td><?php echo $row['fname']." ".$row['lname'];?></td>
			<td><?php echo $row['roomno'];?></td>
			<td><?php echo $row['start_date'];?></td>
			<?php
			$period=$row['period'];
			if(date('d', strtotime($row['start_date']))!="04"){$period++;}
			$end_date=date('Y-m-04', strtotime($row['start_date']." +".$period." month"));
			?>
			<td><?php echo $end_date;?></td>
			<?php
			if($row['termination_date']=="0000-00-00"){$termination_date="-";}
			else{$termination_date=$row['termination_date'];}
			?>
			<td><?php echo $termination_date;?></td>
			<td><?php echo $row['period'];?></td>
			<?php
			if($row['status']=="Inactive"){$status="#FF0000";}
			else{$status="#02D619";}
			?>
            <td style="color: <?php echo $status;?>;"><?php echo $row['status'];?></td>
			<form action="3.6)lease_search.php" method="post">
			<input type="hidden" name="Lease_id" value="<?php echo $row['Lease_id'];?>">
			<td><button class="open-button" name="edit" value="edit">Edit</button></td>
			</form>
        </tr>
			<?php
			}
			?>
	</table>
</div>
</div>
</header>
<script>
$(window).scroll(function() {
  $("#myForm").css({"margin-top": ($(window).scrollTop()+140) + "px", "margin-left":($(window).scrollLeft()+220) + "px"});

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
