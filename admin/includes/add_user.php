 <?php 
if(isset($_POST['user_add'])){
	$first_name = $_POST['first_name'];
	$last_name = $_POST['last_name'];
	$usr_email = $_POST['usr_email'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	$usr_role = $_POST['usr_role'];
	$avatar = $_FILES['avatar']['name'];
	$avatar_tmp = $_FILES['avatar']['tmp_name'];
	move_uploaded_file($avatar_tmp,"../images/users/$avatar");
// hash password
	$hash = password_hash($password,PASSWORD_DEFAULT,['cost' => 12]);
// Insert into users table
	$users_query = "INSERT INTO users (first_name, last_name, usr_email, username, password, avatar, usr_role,hash) ";
	$users_query .= "VALUES ('$first_name', '$last_name', '$usr_email', '$username', '$password', '$avatar','$usr_role','$hash' )";
	$result_users_query = mysqli_query($connection,$users_query);
	confirm_query($result_users_query);
	echo "<b>User Created : </b>"." ". "<a href='users.php'>View Users</a>";	
	echo '</br></br>';
	}
?>
<form action="" method="post" enctype="multipart/form-data">
	<div class="form-group">
		<label for="first_name">First Name</label>
		<input type="text" name="first_name" class="form-control" placeholder="First Name">
	</div>
	<div class="form-group">
		<label for="last_name">Last Name</label>
		<input type="text" name="last_name" class="form-control" placeholder="Last Name">
	</div>
	<div class="form-group">
		<label for="usr_email">Email</label>
		<input type="email" name="usr_email" class="form-control" placeholder="Email">
	</div>
	<div class="form-group">
		<label for="username">Username</label>
		<input type="text" name="username" class="form-control" placeholder="Username">
	</div>
	<div class="form-group">
		<label for="password">Password</label>
		<input type="password" name="password" class="form-control" placeholder="Password">
	</div>

	<div class="form-group">
		<label for="avatar">Profile Picture</label>
		<input type="file" name="avatar">
	</div>
	<div class="form-group">
		<select name="usr_role" class="form-control">
			<option value="n/a" selected="true" disabled="true">User Role </option>
			<option value="admin">Admin</option>
			<option value="subscriber">Subscriber</option>
		</select>
	</div>
	<div class="form-group">
		<input type="submit" value="Add" name="user_add" class="btn btn-primary">
	</div>
</form>