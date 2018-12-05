<?php include "db.php"; ?>
<?php session_start(); ?>
<?php

if(isset($_POST['log_in'])){
	$username = mysqli_real_escape_string($connection,$_POST['username']);
	$password = mysqli_real_escape_string($connection,$_POST['password']);
$login_query = "SELECT * FROM users WHERE username = '$username' "; 
$result_login_query = mysqli_query($connection,$login_query);
	confirm_query($result_login_query);
	
	// fetch data from users table
while($usr_row = mysqli_fetch_assoc($result_login_query)){
	 $db_usr_id = $usr_row['usr_id'];
	 $db_usr_firstname = $usr_row['first_name'];
	 $db_usr_lastname = $usr_row['last_name'];
	 $db_username = $usr_row['username'];
	 $db_usr_password = $usr_row['password'];
	 $db_usr_role = $usr_row['usr_role'];
}	
	// log in validation 
	
if($username === $db_username && $password === $db_usr_password){
	$_SESSION['username'] = $db_username;
	$_SESSION['firstname'] = $db_usr_firstname;
	$_SESSION['lastname'] = $db_usr_lastname;
	$_SESSION['user_role'] = $db_usr_role;
	header("Location: ../admin");
} else {
	header("Location: ../index.php?login=invalid");
	}
}
