<?php 

if(isset($_GET['usr_id'])){
	$usr_id = $_GET['usr_id'];
	
// Show users from database
	$edit_user_query = "SELECT * FROM users WHERE usr_id = $usr_id ";
	$edit_query_result = mysqli_query($connection,$edit_user_query);
		while($row = mysqli_fetch_assoc($edit_query_result)){
			$edit_first_name = $row['first_name'];
			$edit_last_name = $row['last_name'];
			$edit_email = $row['usr_email'];
			$edit_username = $row['username'];
			$edit_password = $row['password'];
			$edit_usr_role = $row['usr_role']; 
			$edit_avatar = $row['avatar']; 
		}
	}
	
// Update user data into databse	
if(isset($_POST['update_user'])){
	$usr_id = $_GET['usr_id'];
	$first_name = $_POST['first_name'];
	$last_name = $_POST['last_name'];
	$email = $_POST['usr_email'];
	$username = $_POST['username'];
	$password = $_POST['password'];
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
	
	$update_user_query = "UPDATE users SET ";
	$update_user_query .= "first_name = '$first_name', last_name = '$last_name', usr_email = '$email', ";
	$update_user_query .= "username = '$username', password = '$password',avatar = '$user_avatar',usr_role = '$usr_role'  ";
	$update_user_query .= "WHERE usr_id = $usr_id ";
	
	$update_query_result = mysqli_query($connection,$update_user_query);
	confirm_query($update_query_result);
	echo "<b>User Updated.</b>"."  "."<a href='users.php'>View Users</a>";
	echo '</br></br>';
	}
?>

<form action="" method="post" enctype="multipart/form-data">
	<div class="form-group">
		<label for="first_name">First Name</label>
		<input type="text" value="<?php echo $edit_first_name; ?>" name="first_name" class="form-control" placeholder="First Name">
	</div>
	<div class="form-group">
		<label for="last_name">Last Name</label>
		<input type="text" value="<?php echo $edit_last_name; ?>" name="last_name" class="form-control" placeholder="Last Name">
	</div>
	<div class="form-group">
		<label for="usr_email">Email</label>
		<input type="email" value="<?php echo $edit_email; ?>" name="usr_email" class="form-control" placeholder="Email">
	</div>
	<div class="form-group">
		<label for="username">Username</label>
		<input type="text" value="<?php echo $edit_username; ?>" name="username" class="form-control" placeholder="Username">
	</div>
	<div class="form-group">
		<label for="password">Password</label>
		<input type="password" value="<?php echo $edit_password; ?>" name="password" class="form-control" placeholder="Enter New Password">
	</div>
<div class="form-group">
		<label for="avatar">Profile Picture</label><br>
		<img src="../images/users/<?php echo $edit_avatar; ?>" alt="image" class="avatar-lg"><br><br>
		<input type="file" name="avatar">
	</div>
	<div class="form-group">
		<select name="usr_role" class="form-control">
			<option value="<?php echo $edit_usr_role; ?>" selected="true"><?php echo $edit_usr_role; ?></option>
			<?php 
				if($edit_usr_role == 'admin'){
					echo "<option value='subscriber'>Subscriber</option>";
				} else {
					echo "<option value='admin'>Admin</option>";
				}
			?>
		</select>
	</div>
	<div class="form-group">
		<input type="submit" value="Update" name="update_user" class="btn btn-primary">
	</div>
</form>