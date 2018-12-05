<?php include "includes/admin_header.php"; ?>
<?php 

if(isset($_SESSION['username'])){
$username = $_SESSION['username'];	
$profile_query = "SELECT * FROM users WHERE username = '$username' ";	
$result_profile_qury = mysqli_query($connection,$profile_query);
confirm_query($result_profile_qury);
	
while($row = mysqli_fetch_assoc($result_profile_qury)){
	$usr_id = $row['usr_id'];
	$usr_firstname = $row['first_name'];
	$usr_lastname = $row['last_name'];
	$usr_email = $row['usr_email'];
	$usr_name = $row['username'];
	$usr_pwd = $row['password'];
	$usr_role = $row['usr_role']; 
	$usr_avatar = $row['avatar']; 
  }	
}

// update user profile
		
if(isset($_POST['update_profile'])){
	$first_name = $_POST['first_name'];
	$last_name = $_POST['last_name'];
	$email = $_POST['usr_email'];
	$user_name = $_POST['username'];
	$user_pwd = $_POST['password'];
	$usr_role = $_POST['usr_role'];
   
	$user_avatar = $_FILES['avatar']['name'];
	$user_avatar_tmp = $_FILES['avatar']['tmp_name'];

	move_uploaded_file($user_avatar_tmp,"../images/users/$user_avatar");
if(empty($user_avatar)){
		$avatar_query = "SELECT * FROM users WHERE usr_id = $usr_id ";
		$result_avatar_query = mysqli_query($connection,$avatar_query);
	while($row = mysqli_fetch_assoc($result_avatar_query)){
			$user_avatar = $row['avatar'];
		}
	} 
	
$upd_profile_query  = "UPDATE users SET first_name = '$first_name', last_name = '$last_name', ";
$upd_profile_query .= "usr_email = '$email', avatar = '$user_avatar',usr_role = '$usr_role', ";
$upd_profile_query .= "username = '$username', password = '$user_pwd' ";
$upd_profile_query .= "WHERE usr_id = $usr_id ";

$update_query_result = mysqli_query($connection,$upd_profile_query);
confirm_query($update_query_result);
	header("Location: profile.php");

}

?>

<div id="wrapper">

<!-- Navigation -->
<?php include "includes/admin_navigation.php"; ?>

<div id="page-wrapper">

<div class="container-fluid">

<!-- Page Heading -->
<div class="row">
<div class="col-lg-12">
<h1 class="page-header">
	Profile
	<small>
		<?php echo $usr_firstname." ".$usr_lastname; ?></small>
</h1>
<form action="" method="post" enctype="multipart/form-data">
	<div class="form-group">
		<label for="first_name">First Name</label>
		<input type="text" value="<?php echo $usr_firstname; ?>" name="first_name" class="form-control" placeholder="First Name">
	</div>
	<div class="form-group">
		<label for="last_name">Last Name</label>
		<input type="text" value="<?php echo $usr_lastname; ?>" name="last_name" class="form-control" placeholder="Last Name">
	</div>
	<div class="form-group">
		<label for="usr_email">Email</label>
		<input type="email" value="<?php echo $usr_email; ?>" name="usr_email" class="form-control" placeholder="Email">
	</div>
	<!-- username should not be changed -> to prevent errors for ongoing session
	<div class="form-group">
		<label for="username">Username</label>
		<input type="text" value="<?php //echo $usr_name; ?>" name="username" class="form-control" placeholder="Username">
	</div> -->
	<div class="form-group">
		<label for="password">Password</label>
		<input type="password" value="<?php echo $usr_pwd; ?>" name="password" class="form-control" placeholder="Enter New Password">
	</div>
	<div class="form-group">
		<label for="avatar">Profile Picture</label><br>
		<img src="../images/users/<?php echo $usr_avatar; ?>" alt="image" class="avatar-lg"><br><br>
		<input type="file" name="avatar">
	</div>
	<div class="form-group">
		<select name="usr_role" class="form-control">
			<option value="<?php echo $usr_role; ?>" selected="true">
				<?php echo $usr_role; ?> </option>
		<?php 
			if($usr_role == 'admin'){
				echo "<option value='subscriber'>Subscriber</option>";
			} else {
				echo "<option value='admin'>Admin</option>";
			}
		?>
		</select>
	</div>
	<div class="form-group">
		<input type="submit" value="Update Profile" name="update_profile" class="btn btn-primary">
	</div>
</form>

</div>

<!-- /.row -->
</div>
<!-- /.container-fluid -->

</div>


<?php include "includes/admin_footer.php"; ?>