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
		echo '<a href="3.5)lease_input.php" class="button"><i class="fa fa-th"></i> LEASE</a>';
		echo '<a href="4.5)billing_input.php" class="button"><i class="fas fa-receipt"></i> BILLING</a>';
		echo '<a href="5)staff-maintenance_request.php" class="button"><i class="fas fa-wrench"></i> MAINTENANCE</a>';
		echo '<a href="6)staff-parcel_input.php" class="button selected"><i class="fas fa-shipping-fast"></i> PARCEL</a>';
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
		echo '<a href="6)staff-parcel_input.php" class="button selected"><i class="fas fa-shipping-fast"></i> PARCEL</a>';
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

<!-- Pop up form -->
<?php
if(isset($_POST['edit'])){
$gvpackageno=$_POST['gvpackageno'];
$q="select * from packages where gvpackageno=$gvpackageno";
if($result=$mysqli->query($q)){
	$row=$result->fetch_array();
}else{
	echo "Query failed: ".$mysqli->error;
}
}
?>
<div
<?php
if(isset($_POST['edit'])){echo "style='display: block;  margin-left: 220px; margin-top: 100px;'";}
?>
class="form-popup" id="myForm">

<form action="update_package_info.php" class="form-container" method="POST">
	<h1>Update</h1>
	<b>GolfView tag  <?php echo $row['gvpackageno'];?></b>
      <b>Delivery company</b><input Class="sign" type="text" value="<?php echo $row['delivery_partner']?>" name="delivery_partner" size="13" required>
      	<?php
		$orgDate = $row['doa'];
		$newDate = date("Y-m-d", strtotime($orgDate)); 
		?>
		<b>Arrival</b><input Class="sign"  type="date" value="<?php echo $newDate;?>" name="doa" required>
      	<?php
		$orgDate = $row['dor'];
		$newDate = date("Y-m-d", strtotime($orgDate)); 
		?>
		<b>Retrieve</b><input Class="sign"  type="date" value="<?php echo $newDate;?>" name="dor">
		<b></b>
		<select name="type_of_package" style="width: fit-content;">
		<?php
			$arr = array("Bag","Box");
			foreach ($arr as &$value) {
			if($value==$row['type_of_package']){
				echo '<option value="'.$value.'" selected>'.$value.'</option>';
			}
			else{
				echo '<option value="'.$value.'" >'.$value.'</option>';
			}
			}
		?>
	    </select>
	  <b>Name</b><input Class="sign" type="text" value="<?php echo $row['owner_name'];?>" name="name" size="6" required>
	  <b>National id/Passport</b><input Class="sign" type="text" value="<?php echo $row['citizen_id'];?>" name="citizen_id" size="6" required>
	  <b>Staff</b><input Class="sign" type="text" value="<?php echo $row['poic'];?>" name="poic" size="6" required>
	<input type="hidden" name="gvpackageno" value="<?php echo $row['gvpackageno']?>">
	<input type="hidden" name="page" value="1">
	<div>
	<input style="background: green;" class="btn" type="submit" name="update" value="Update">
	<input style="margin-left: 10vmax;" class="btn" type="submit" name="delete" value="Delete" onclick="myFunction()">
	</div>
  </form>
</div>

<!-- Header with full-height image -->
<header class="w3-display-container" id="home">
<hr style="margin:-1px; padding:0px;  border-top: 2px solid #838383;">
<div class="types">
<?php
echo '<a href="6)staff-parcel_input.php" class="button">Input</a>';
echo '<a href="6.2)staff-parcel_search.php" class="button selected">Search</a>';
?>
</div>

<!-- Background for popup -->
<div
<?php 
if(isset($_POST['edit'])){echo "style='display: block;'";}
?>
class="form-popup-background" onclick="closeForm();" id="myFormbackground">
</div>

<div style="text-align:center;">
<h2 style="padding:20px 0px 0px; margin:0px; background-color: #F9F9F9;">Package records</h2>
  <form style="text-align:center; background-color: #F9F9F9;" action="6.2)staff-parcel_search.php" method="POST">
      <input Class="sign" type="text" placeholder="GolfView tag" name="GolfView_tag" size="8">
      <input Class="sign" type="text" placeholder="Delivery company" name="Delivery_company" size="13">
      <b>Arrival</b><input Class="sign"  type="date" name="Date_of_arrival">
      <b>Retrieve</b><input Class="sign"  type="date" name="Date_of_retrieve">
        <select name="type" id="type" style="width: fit-content;">
			<option value="">Neither</option>
			<option value="bag">Bag</option>
			<option value="box">Box</option>
		</select>
      <input Class="sign" type="text" placeholder="Name" name="Name" size="25">
	  <input Class="sign" type="text" placeholder="National id" name="National_id" size="10">
	  <input Class="sign" type="text" placeholder="Staff id" name="poic" size="6" >
	  <input style="font-size: 17px;" class="button1" type="submit" name="submit" value="Search"><br>
  </form>
</div>

<div style=" padding: 0px 0px 10px; background-color: #F9F9F9;">
<?php 
 $q="select * from packages";

if(isset($_POST['submit']) && $_POST['submit']=="Search") {
	$gvpackageno=$_POST['GolfView_tag'];
	$delivery_partner=$_POST['Delivery_company'];
	$doa=$_POST['Date_of_arrival'];
	$dor=$_POST['Date_of_retrieve'];
	$type_of_package=$_POST['type'];
	$owner_name=$_POST['Name'];
	$citizen_id=$_POST['National_id'];
	$poic=$_POST['poic'];

	$q="select * from packages where gvpackageno like '%$gvpackageno%'
	and delivery_partner like '%$delivery_partner%' and doa like '%$doa%' and dor like '%$dor%' 
	and type_of_package like '%$type_of_package%' and owner_name like '%$owner_name%' 
	and citizen_id like '%$citizen_id%' and poic like '%$poic%'";
}

if($result=$mysqli->query($q)){
	$count=$result->num_rows;
	
	if($count==0){$color1="#FF0000";}
	else{$color1="#02D619";}
?>
<div style="padding: 0px 0px 15px; text-align: center; color: <?php echo $color1;?>;">
<?php
	echo "Total $count records";
	echo '</div>';
}else{
	echo "Query failed: ".$mysqli->error;
}
?>

	<table style="text-align:center; margin: auto; padding: 0px 0px 10px;">

        <tr>
			<th>GolfView tag</th> 
            <th>Delivery company</th> 
            <th>Date of arrival</th>
			<th>Date of retrieve</th>
            <th>type</th>
			<th>Name</th>
			<th>National id</th>
			<th>Staff id</th>
        </tr>
		<?php 
			$i=1;
		 while($row=$result->fetch_array()){ ?>
		<?php 
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

         <tr style="padding:5px; background-color: <?php echo $color;?>;">
            <td><?php echo $row['gvpackageno'];?></td> 
            <td><?php echo $row['delivery_partner'];?></td> 
            <td><?php echo $row['doa'];?></td> 
			<td><?php if($row['dor']=='0000-00-00'){echo "-";}else{echo $row['dor'];} ?></td> 
            <td><?php echo $row['type_of_package'];?></td> 
            <td><?php echo $row['owner_name'];?></td>
            <td><?php echo $row['citizen_id'];?></td>
            <td><?php echo $row['poic'];?></td>
			<form action="6.2)staff-parcel_search.php" method="post">
			<input type="hidden" name="gvpackageno" value="<?php echo $row['gvpackageno'];?>">
			<td><button class="open-button" name="edit" value="edit">Edit</button></td>
			</form>
        </tr>                               
		<?php }?>

	</table>
</div>

</header>
<script>
$(window).scroll(function() {
  $("#myForm").css({"margin-top": ($(window).scrollTop()+100) + "px", "margin-left":($(window).scrollLeft()+220) + "px"});

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
