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
      <a href="7)staff-profile.php"     class="button selected"><i class="fa fa-user-circle"></i></a>
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
<?php
$staff_id = $_SESSION['staff_id'];
$q="select * from staff where staff_id=$staff_id";
$result=$mysqli->query($q);
if(!$result){
	echo 'Query error: '.$mysqli->error;
}
$row=$result->fetch_array();
if(!isset($_POST['Edit'])){
if(isset($_POST['Save_password'])){
	if($row['spassword']==md5($_POST['opasswd'])){
		$id=$_POST['staff_id'];
		$passwd=md5($_POST['passwd']);
		$q="UPDATE staff SET spassword='$passwd' WHERE staff_id=$id";
		$result=$mysqli->query($q);
		if(!$result){
			echo $mysqli->connect_errno.": ".$mysqli->connect_error;
		}
		$_SESSION['check']="0";
	}
	else{
		$_SESSION['check']="1";
	}
}
?>

<div style="background-color: #F9F9F9;">
<h2 style="text-align:center; padding:25px 0px 20px; margin:0px; ">Staff Member Profile</h2>
<div class="grid-container" style="padding: 0px 30px;">
	<div class="grid-item" style="text-align: center;">
	
<?php 
// If file upload form is submitted 
$status = $statusMsg = ''; 
if(isset($_POST["staff_id"])){ 
	$status = 'error'; 
	if(!empty($_FILES["image"]["name"])) { 
		// Get file info 
		$fileName = basename($_FILES["image"]["name"]); 
		$fileType = pathinfo($fileName, PATHINFO_EXTENSION); 
		
		// Allow certain file formats 
		$allowTypes = array('jpg','png','jpeg','gif'); 
		if(in_array($fileType, $allowTypes)){ 
			$image = $_FILES['image']['tmp_name']; 
			$imgContent = addslashes(file_get_contents($image)); 
			$staff_id = $_POST['staff_id'];
			
			// Insert image content into database 
				$q="INSERT into staff_profile_images (image, uploaded, staff_id) VALUES ('$imgContent', NOW(),'$staff_id')";
				
				$resul = $mysqli->query("SELECT image FROM staff_profile_images WHERE staff_id='$staff_id'");
				if($resul->num_rows > 0){
					$q="UPDATE staff_profile_images SET image='$imgContent', uploaded=NOW() WHERE staff_id='$staff_id'"; 
				}
				$insert = $mysqli->query($q); 
			
			if($insert){ 
			}else{ 
				$statusMsg = "File upload failed, please try again."; 
			}  
		}else{ 
			$statusMsg = 'Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.'; 
		} 
	}else{ 
		$statusMsg = 'Please select an image file to upload.'; 
	}
} 
?>
	
	<div onmouseover="showForm();" onmouseout="hideForm();" onclick="showForm();" >
	<form action="7)staff-profile.php" method="post" id="image-form" enctype="multipart/form-data">
	<label for="upload" class="custom-file-upload">Upload</label>
	<input onchange='this.form.submit()' id="upload" type="file" name="image">
	<input type="hidden" name="staff_id" value="<?php echo $staff_id;?>"><br>
	<noscript><input type="submit" value="upload"></noscript>
	</form>
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
	</div>
	
	<form action="7)staff-profile.php" method="POST">
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
		
		<?php
		if($_SESSION['check']=="0" && !isset($_POST['Change_password'])){
		?>
		
		<input class="button1" style="margin: 20px;" type="submit" name="Edit" value="Edit">
		<input class="button1" style="margin: 20px;" type="submit" name="Change_password" value="Change password"><br>
		
		<?php
		}
		else{
		if($_SESSION['check']=="1"){
			echo "<label for='opasswd' style='color: red;'>Incorrect password</label><br>";
		}
		?>
		<div class="grid-item">
		<input Class="sign" type="password" placeholder="Old Password" id="opasswd" name="opasswd" size="15" required></div>
		<div class="grid-item">
		<input Class="sign" type="password" placeholder="New Password" name="passwd" size="15" required>
		<input Class="sign" type="password" placeholder="*Confirm Password" size="15" required>
		</div>
		<input type="hidden" name="staff_id" value="<?php echo $row['staff_id']?>">
		<input class="button1" style="margin: 20px;" type="submit" name="Save_password" value="Save password"><br>

		<?php
		}
		?>
	</form>
</div>
</div>
</div>
</div>
<?php
}
elseif(isset($_POST['Edit'])){?>
<div style="background-color: #F9F9F9;">
<h2 style="text-align:center; padding:25px 0px 20px; margin:0px; ">Staff Member Profile</h2>
<div class="grid-container" style="padding: 0px 30px;">
	<div class="grid-item" style="text-align: center;">
	<?php 
	$resul = $mysqli->query("SELECT image FROM staff_profile_images WHERE staff_id='$staff_id'"); 
	if($resul->num_rows > 0){ ?> 
    <div style="width:300px;" > 
        <?php while($ro = $resul->fetch_assoc()){ 
            echo '<img style="width:100%" src="data:image/jpg;charset=utf8;base64,'.base64_encode($ro['image']).'"/>';
         } ?> 
    
	<?php }else{ 
	echo "<img src='images\profile.png' alt='photo of staff'/>";
	}
	?>
	</div>
	<form action="update_staff_info.php" method="POST"><br>		
	<select id="title" name="title" style="width: fit-content;">
		<?php
			$arr = array("Mr.","Mrs.","Miss");
			foreach ($arr as &$value) {
			if($value==$row['title']){
				echo '<option value="'.$value.'" selected>'.$value.'</option>';
			}
			else{
				echo '<option value="'.$value.'" >'.$value.'</option>';
			}
			}
		?>
	</select>
	
	<div>
	<h5><?php echo $row['sfname'];?> <?php echo $row['smname'];?> <?php echo $row['slname'];?></h5>
	</div>
	
	</div>
	<div class="grid-item" style="padding: 0px 30px;">
	<div class="grid-container">	                                                                                                                              
		<div class="grid-item"><b>Department</b></div>
		<div class="grid-item"><h6><?php echo $row['department'];?></h6<br></div>
		
		<div class="grid-item"><b>Position</b></div>
		<div class="grid-item"><h6><?php echo $row['position'];?></h6><br></div>
		
		<div class="grid-item"><b>Telephone</b></div>
		<div>
		<h6><input Class="sign" style="margin:0;" type="text" value="0<?php echo $row['telephone'];?>" name="telephone" required></h6><br>
		</div>
		
		<div class="grid-item"><b>NationalID/Passport</b></div>
		<div class="grid-item"><h6><?php echo $row['national_id'];?></h6<br></div>

		<div class="grid-item"><b>Email</b></div>
		<div>
		<h6><input Class="sign" style="margin:0;" type="text" value="<?php echo $row['email'];?>" name="email" required></h6><br>
		</div>
		
		<div class="grid-item"><b>Enroll date</b></div>
		<div class="grid-item"><h6><?php echo $row['enroll_date'];?></h6><br></div>
		
		<div class="grid-item"><b>Salary</b></div>
		<div class="grid-item">
		<h6><?php echo $row['salary'];?></h6><br>
		</div>
		
		<div class="grid-item"><b>Birthday</b></div>
		<div class="grid-item">
		<h6><?php echo $row['sDOB'];?></h6><br>
		</div>
		
		<div class="grid-item"><b>Civil Status</b></div>
		<div>
		<select id="Civil" name="civil_status" style="width: fit-content;">
		<?php
			$arr = array("Single","Married","Divorced","Widowed");
			foreach ($arr as &$value) {
			if($value==$row['civil_status']){
				echo '<option value="'.$value.'" selected>'.$value.'</option>';
			}
			else{
				echo '<option value="'.$value.'" >'.$value.'</option>';
			}
			}
		?>
	    </select>
		</div>
		
		<div class="grid-item"><b>Address </b></div>
		<div>
		<h6><input Class="sign" style="margin:0;" type="text" value="<?php echo $row['address'];?>" name="address" size="120" required></h6><br>
		</div>
		
		<div class="grid-item"><b>Languages Ability</b></div>
		<div>
		<h6><input Class="sign" style="margin:0;" type="text" value="<?php echo $row['language_ability'];?>" name="language_ability" size="50" required></h6><br>
		</div>
		<input type="hidden" name="staff_id" value="<?php echo $row['staff_id']?>">
		<input class="button1" style="margin: 20px;" type="submit" name="Save" value="Save"><br>
	</form>
</div>
</div>
</div>
</div>
<?php
}
?>
<script>
function image() {
    document.getElementById("image-form").submit();
}

function showForm(){
    document.getElementById('image-form').style.display = "block";
}

function hideForm(){
    document.getElementById('image-form').style.display = "none";
}
</script>

</body>
</header>

</html>