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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
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
  <a href="javascript:void(0)" onclick="w3_close()" class="w3-bar-item w3-button w3-large w3-padding-16">Close ×</a>
  <a href="" onclick="w3_close()" class="w3-bar-item w3-button">MEMBERS</a>
  <a href="" onclick="w3_close()" class="w3-bar-item w3-button">ADD-MEMBERS</a>
  <a href="" onclick="w3_close()" class="w3-bar-item w3-button">BOOK NOW</a>
  <a href="" onclick="w3_close()" class="w3-bar-item w3-button">WORK</a>
  <a href="" onclick="w3_close()" class="w3-bar-item w3-button">PRICING</a>
  <a href="" onclick="w3_close()" class="w3-bar-item w3-button">CONTACT US</a>
  <a href="" onclick="w3_close()" class="w3-bar-item w3-button">SIGN OUT</a>
</nav>


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

<!-- Popup form -->
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
<input type="hidden" name="member_id" value="<?php echo $row['member_id']?>">
<input type="hidden" name="lease_id" value="<?php echo $row['Lease_id']?>">
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
echo '<a href="3.5)lease_input.php" class="button selected">Input</a>';
echo '<a href="3.6)lease_search.php" class="button">Search</a>'
?>
</div>

<!-- Popup form background -->
<div 
<?php 
if(isset($_POST['edit'])){echo "style='display: block;'";}
?>
class="form-popup-background" onclick="closeForm(); close();" id="myFormbackground">
</div>

<?php
$q="SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA = 'golf_view' AND TABLE_NAME = 'lease'";
$result=$mysqli->query($q);
if(!$result){
echo $mysqli->connect_errno.": ".$mysqli->connect_error;
}
$row=$result->fetch_array();
$Lease_id=$row['AUTO_INCREMENT'];
if(isset($_POST['submit'])) {
$Lease_id=$Lease_id+1;}

?>
<!--%%%%% Form for Request %%%%-->
<div style="text-align:center; background-color: #F9F9F9; margin: auto;">
<h2 style="padding: 10px 0px 10px; margin:0px;">Input lease</h2>
  <form action="3.5)lease_input.php" method="POST">
      <b>Lease ID  <?php echo $Lease_id;?></b>
      <input Class="main" type="text" placeholder="User ID" name="user_id" size="7" required>
	  
      	<input list="roomlist" Class="main" placeholder="Room No" name="roomno" size="8" required>
	<datalist id="roomlist">
	  <?php
	  $roomlist="SELECT * FROM room_info WHERE member_id='0'";
	if($list=$mysqli->query($roomlist)){
		while($room_list=$list->fetch_array()){
			echo '<option value="'.$room_list['roomno'].'">';
		}
	}
	  ?>
	</datalist>

      <b>Start date</b><input Class="main"  type="date" value="<?php echo date('Y-m-d');?>" name="start_date" required>
	    <select name="period" style="width: fit-content;" required>
			<option>period</option>
			<option value="3">3 months</option>
			<option value="6">6 months</option>
			<option value="12">12 months</option>
		</select>
		<select name="civil_status" style="width: fit-content;" required>
			<option>Civil status</option>
			<option value="Single">Single</option>
			<option value="Married">Married</option>
			<option value="Divorced">Divorced</option>
			<option value="Widowed">Widowed</option>
	    </select>
	  <input class="btn" type="submit" name="submit" value="Submit"><br>
  </form>
</div>



<div style=" background-color: #F9F9F9;">
<?php
if(isset($_POST['submit'])) {
/*----- Check if they already have a member account ------*/
	$user_id=$_POST['user_id'];
	$civil_status=$_POST['civil_status'];
	$roomno=$_POST['roomno'];
	
	$check = $mysqli->query("SELECT * FROM member WHERE user_id='$user_id'"); 
	if($check->num_rows > 0){
		$condition1="UPDATE member SET status='Active', roomno='$roomno', civil_status='$civil_status'
		WHERE user_id='$user_id'";
	}
	else{
	$condition1="INSERT INTO member (member_id,user_id,roomno,civil_status)
	VALUES ('','$user_id','$roomno','$civil_status')";
	}
	$insert=$mysqli->query($condition1);
	if(!$insert){
		echo $mysqli->connect_errno.": ".$mysqli->connect_error;
	}

/*----- Create lease ------*/	
	$condition2="SELECT * FROM member WHERE user_id=$user_id";
	$insert=$mysqli->query($condition2);
	$Insert=$insert->fetch_array();
	$member_id=$Insert['member_id'];

	$start_date=$_POST['start_date'];
	$period=$_POST['period'];

	$condition3="INSERT INTO lease (Lease_id,member_id,roomno,start_date,period)
	VALUES ('','$member_id','$roomno','$start_date','$period')";
	$result=$mysqli->query($condition3);
	if(!$result){
		echo $mysqli->connect_errno.": ".$mysqli->connect_error;
	}
	
/*----- Change room to unavailable ------*/	
	$Update="UPDATE room_info SET member_id='$member_id',
	room_info.status='Taken'
	WHERE roomno='$roomno'";
	$Update=$mysqli->query($Update);
	if(!$Update){
		echo $mysqli->connect_errno.": ".$mysqli->connect_error;
	}
}
?>	

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

<div style="text-align: center; padding-bottom: 30px;">
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
			<form action="3.5)lease_input.php" method="post">
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
