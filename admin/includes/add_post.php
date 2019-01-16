 <?php

if(isset($_POST['publish_post'])){
	
	$post_title = $_POST['title'];
	$post_author = $_POST['author'];
	$post_category_id = $_POST['post_category'];
	$post_status = $_POST['post_status'];
	// uploading image - [img-name][attribute]
	$post_img = $_FILES['post_img']['name'];
	// temp location on server to store imgs
	$post_img_tmp = $_FILES['post_img']['tmp_name'];
	$post_tags = $_POST['post_tags'];
	$post_content = $_POST['post_content'];
	$post_date = date("F j, Y, g:i A");

// move the uploaded files
	move_uploaded_file($post_img_tmp,"../images/$post_img");

	$post_query = "INSERT INTO posts (post_cat_id,post_title,post_author,post_date,post_img,post_content,post_tags,post_status) ";
	$post_query .= "VALUES ($post_category_id,'$post_title','$post_author',now(),'$post_img','$post_content','$post_tags','$post_status' )";
	$publish_query = mysqli_query($connection,$post_query);
	confirm_query($publish_query);
	
	// fetch post id just created
	$post_id = mysqli_insert_id($connection);
	
	echo "<b>Post Added.</b>"."  "."<a href='../post.php?p_id=$post_id'>View Post</a>  <b>or</b>  <a href='posts.php?source=add_post'>Add Another Post</a>";
	echo '</br></br>';
 }
?>
<form action="" method="post" enctype="multipart/form-data">
	<div class="form-group">
		<label for="title">Post Title</label>
		<input type="text" name="title" class="form-control" placeholder="Enter Post Title">
	</div>
	<div class="form-group">
		<select name="post_category" class="form-control   ">
			<option selected="true" disabled="true" value="n/a">Select Category</option>
		<?php 
			// Show categories Available
			$query = "SELECT * FROM categories ";			
			$select_cat = mysqli_query($connection,$query);
			confirm_query($select_cat);
		while($row = mysqli_fetch_assoc($select_cat)){
			$cat_id = $row['cat_id'];
			$cat_title = $row['cat_title'];
	echo "<option value='$cat_id'>$cat_title</option>"; } ?>
		</select>
	</div>
	<div class="form-group">
		<label for="author">Post Author</label>
		<input type="text" name="author" class="form-control" placeholder="Enter Post Author">
	</div>
	<div class="form-group">
		<label for="post_status">Post Status</label>
		<select name="post_status" class="form-control">
			<option selected disabled>Select</option>
			<option value="draft">Draft</option>
			<option value="published">Publish</option>
		</select>		
	</div>
	<div class="form-group">
		<label for="post_img">Post Image</label>
		<input type="file" name="post_img">
	</div>
	<div class="form-group">
		<label for="post_tags">Post Tags</label>
		<input type="text" name="post_tags" class="form-control" placeholder="Enter Post Tags">
	</div>
	<div class="form-group">
		<label for="post_content">Post Content</label>
		<textarea name="post_content" class="form-control" placeholder="Write..." cols="30" rows="10" id="editor"></textarea>
	</div>
	<div class="form-group">
		<input type="submit" value="Publish" name="publish_post" class="btn btn-primary">
	</div>
	
</form>
