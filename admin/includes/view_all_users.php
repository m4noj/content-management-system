<table class="table table-hover table-bordered">
	<thead>
		<tr>
			<th class="text-center">Id</th>
			<th class="text-center">First Name</th>
			<th class="text-center">Last Name</th>
			<th class="text-center">Username</th>
			<th class="text-center">Email</th>
			<th class="text-center">Avatar</th>
			<th class="text-center">Role</th>
			<th class="text-center" colspan="4">Option</th>
		</tr>
	</thead>
	<tbody>
		<?php 
	// Show all users from database
	$users_query = "SELECT * FROM users ";
	$users_query_result = mysqli_query($connection,$users_query);
		while($row = mysqli_fetch_assoc($users_query_result)){
			$usr_id = $row['usr_id'];
			$username = $row['username'];
			$password = $row['password'];
			$first_name = $row['first_name'];
			$last_name = $row['last_name'];
			$usr_email = $row['usr_email'];
			$avatar = $row['avatar'];
			$usr_role = $row['usr_role'];
			
	echo "
			<tr>
				<td class='text-center'>$usr_id</td>
				<td class='text-center'>$first_name</td>
				<td class='text-center'>$last_name</td>
				<td class='text-center'>$username</td>
				<td class='text-center'>$usr_email</td>
				<td class='text-center'><img src='../images/users/$avatar' class='avatar'></td>
				<td class='text-center'><b>$usr_role</b></td>
				<td class='text-center'><a href='users.php?change_to_admin=$usr_id'>Admin</a></td>
				<td class='text-center'><a href='users.php?change_to_sub=$usr_id'>Subscriber</a></td>
				<td class='text-center'><a href='users.php?source=edit_user&usr_id=$usr_id'>Edit</a></td>
				<td class='text-center'><a href='users.php?delete=$usr_id'>Delete</a></td>
			</tr>";
		}
?>
	</tbody>
</table>

<?php

// change to admin	
if(isset($_GET['change_to_admin'])){
	$admin_id = $_GET['change_to_admin'];
	$change_admin_query = "UPDATE users SET usr_role = 'admin' WHERE usr_id = $admin_id ";
	$admin_query_result = mysqli_query($connection,$change_admin_query);
	header("Location: users.php");
  }

// change to subscriber
if(isset($_GET['change_to_sub'])){
	$sub_id = $_GET['change_to_sub'];
	$sub_query = "UPDATE users SET usr_role = 'subscriber' WHERE usr_id = $sub_id ";
	$sub_query_result = mysqli_query($connection,$sub_query);
	header("Location: users.php");
  }

// delete users
if(isset($_GET['delete'])){
	$users_del_id = $_GET['delete'];
	$users_del_query = "DELETE FROM users WHERE usr_id = $users_del_id ";
	$del_query_result = mysqli_query($connection,$users_del_query);
	header("Location: users.php");
  }

?>
