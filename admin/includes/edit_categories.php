<?php 
// edit placeholder
$query = "SELECT * FROM categories WHERE cat_id = '$cat_edit_id' ";			
$select_cat = mysqli_query($connection,$query);
	while($row = mysqli_fetch_assoc($select_cat)){
		$cat_id = $row['cat_id'];
		$cat_title = $row['cat_title'];
	}
 echo "<form action='' method='post'>
	<div class='form-group'>
		<label for='cat_title'>Edit Catagory</label>
		<input value='$cat_title' class='form-control' type='text' name='cat-new-title' Placeholder='Enter New Title'>
	</div>
	<div class='form-group'>
		<input class='btn btn-primary' type='submit' name='submit' value='Update'>
	</div>
</form>";

 // Update query
if(isset($_POST['submit'])){
 $cat_new_title = $_POST['cat-new-title'];
 $edit_query = "UPDATE categories SET cat_title = '$cat_new_title' WHERE cat_id ='$cat_edit_id' ";
 $edit_result = mysqli_query($connection,$edit_query);
 header("Location: categories.php");
}