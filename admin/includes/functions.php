<?php

// Adding Categories
function insert_categories(){
	global $connection;
if(isset($_POST['submit'])){
	$cat_title = $_POST['cat_title'];
	if($cat_title =="" || empty($cat_title)){
		echo "<h4 style='color:red;'>This field should not be empty</h4>";
	} else {
		$query = "INSERT INTO categories (cat_title) VALUES ('$cat_title')";
		$add_cat_query = mysqli_query($connection,$query);
			if(!$add_cat_query){
				die("Query FAILED" . mysqli_error($connection));
			} 
		}
	}
}

//FIND all categories
function find_all_categories(){
global $connection;
	$query = "SELECT * FROM categories ";			
	$select_cat = mysqli_query($connection,$query);
while($row = mysqli_fetch_assoc($select_cat)){
	$cat_id = $row['cat_id'];
	$cat_title = $row['cat_title'];
echo "<tr>
		<td class='text-center'>{$cat_id}</td>
		<td class='text-center'>{$cat_title}</td>
		<td class='text-center'><a href='categories.php?delete={$cat_id}'>Delete</a></td>
		<td class='text-center'><a href='categories.php?edit={$cat_id}'>Edit</a></td>
	</tr>";
	} 
}

	// Deleting Categories query			
function del_categories(){
	global $connection;
 if(isset($_GET['delete'])){
	$cat_del_id = $_GET['delete'];
	 $del_query = "DELETE FROM categories WHERE cat_id ='$cat_del_id' ";
	 $del_result = mysqli_query($connection,$del_query);
	 header("Location: categories.php");
	}
}

// show users online
function users_online(){
	if(isset($_GET['usrsonline'])){
	   global $connection;
		if(!$connection) {
			session_start();
			include "../../includes/db.php";
			$session = session_id();
			$time = time();
			$time_out_sec = 05;
			$time_out = $time - $time_out_sec;
			$query = "SELECT * FROM users_online WHERE session = '$session' ";
			$send_query = mysqli_query($connection,$query);
			if(mysqli_num_rows($send_query) == null){
				mysqli_query($connection,"INSERT INTO users_online(session,time) VALUES('$session','$time') ");
			} else {
				mysqli_query($connection,"UPDATE users_online SET time = '$time' WHERE session = '$session' ");
			}
			$users_online = mysqli_query($connection,"SELECT * FROM users_online WHERE time > '$time_out' ");
			echo $count = mysqli_num_rows($users_online);
		}
	}
}

users_online();