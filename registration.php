<?php include "includes/db.php"; ?>
<?php include "includes/header.php"; ?>
<?php include "includes/navigation.php"; ?>
<?php 
if(isset($_POST['submit'])){
	if(!empty($_POST['username']) && !empty($_POST['email']) && !empty($_POST['password'])){
		$username =  mysqli_real_escape_string($connection,$_POST['username']);
		$email =  mysqli_real_escape_string($connection,$_POST['email']);
		$pass =  mysqli_real_escape_string($connection,$_POST['password']);
		$reg_query = "INSERT INTO users(username,usr_email,password,usr_role) VALUES('$username','$email','$pass','subscriber') ";
		$res_reg_query = mysqli_query($connection,$reg_query);
		confirm_query($res_reg_query);
		$msg = "Registered Successfully!";
	} else {
		$msg = "Fields cannot be empty.";
	} 
} else {
		$msg = "";
	}
?>

<!-- Page Content -->
<div class="container">
<section id="login">
<div class="container">
<div class="row">
<div class="col-xs-6 col-xs-offset-3">
<div class="form-wrap">
		<h1 class='text-center'>Register</h1><br>
	<form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
	<h5 class='text-center'><?php echo $msg; ?></h5>
			<div class="form-group">
			<label for="username" class="sr-only">username</label>
			<input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username">
		</div>
		<div class="form-group">
			<label for="email" class="sr-only">Email</label>
			<input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
		</div>
		<div class="form-group">
			<label for="password" class="sr-only">Password</label>
			<input type="password" name="password" id="key" class="form-control" placeholder="Password">
		</div>
		<input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
	</form>

</div>
</div> 
</div> 
</div> 
</section>
	<hr>
<?php include "includes/footer.php";?>
