<?php 
if(isset($_GET['p_id'])){
	$edit_post_id = $_GET['p_id'];
	
// Show posts from database
	$edit_post_query = "SELECT * FROM posts WHERE post_id = $edit_post_id ";
	$edit_query_result = mysqli_query($connection,$edit_post_query);
		while($row = mysqli_fetch_assoc($edit_query_result)){
			$edit_title = $row['post_title'];
			$edit_author = $row['post_author'];
			$edit_status = $row['post_status'];
			$edit_post_cat_id = $row['post_cat_id'];
			$edit_img = $row['post_img'];
			$edit_tags = $row['post_tags'];
			$edit_content = $row['post_content'];
			$edit_comment_count = $row['post_comment_count'];
			$edit_date = $row['post_date']; } 
	}
if(isset($_POST['update_post'])){
	$post_id = $_GET['p_id'];
	$post_title = $_POST['title'];
	$post_author = $_POST['author'];
	$post_category_id = $_POST['post_category'];
	$post_status = $_POST['post_status'];
	$post_img = $_FILES['post_img']['name'];
	$post_img_tmp = $_FILES['post_img']['tmp_name'];
	$post_tags = $_POST['post_tags'];
	$post_content = $_POST['post_content'];

move_uploaded_file($post_img_tmp,"../images/$post_img");
if(empty($post_img)){
		$img_query = "SELECT * FROM posts WHERE post_id = $post_id ";
		$result_img_query = mysqli_query($connection,$img_query);
		while($row = mysqli_fetch_assoc($result_img_query)){
			$post_img = $row['post_img'];
		}
	}
	
	$update_post_query = "UPDATE posts SET post_title = '$post_title', post_author = '$post_author', post_cat_id = '$post_category_id', post_date = now(), post_img = '$post_img', post_status = '$post_status', post_tags = '$post_tags', post_content = '$post_content' WHERE post_id = $post_id ";
	
	$update_query_result = mysqli_query($connection,$update_post_query);
	confirm_query($update_query_result);
	echo "<b>Post Updated.</b>"."  "."<a href='../post.php?p_id=$post_id'>View Post</a>  <b>or</b>  <a href='posts.php'>Edit More Posts</a>";
	echo '</br></br>';
} ?>
 
<form action="" method="post" enctype="multipart/form-data">
	<div class="form-group">
		<label for="title">Post Title</label>
		<input type="text" value="<?php echo $edit_title; ?>"  name="title" class="form-control" placeholder="Enter Post Title">
	</div>
	<div class="form-group">
	<label for="categories">Categories</label>
		<select name="post_category" class="form-control">
		<?php 
		$query = "SELECT * FROM categories ";			
		$select_cat = mysqli_query($connection,$query);
		confirm_query($select_cat);		

	while($row = mysqli_fetch_assoc($select_cat)){
		$cat_id = $row['cat_id'];
		$cat_title = $row['cat_title'];

		if($cat_id == $edit_post_cat_id){
			echo "<option selected value='$cat_id'>$cat_title</option>";
		} else {
			echo "<option value='$cat_id'>$cat_title</option>"; } 
		} ?>
	</select>
	</div>
	<div class="form-group">
		<label for="author">Post Author</label>
		<input type="text" value="<?php echo $edit_author; ?>"  name="author" class="form-control" placeholder="Enter Post Author">
	</div>
	<option value=""></option>
	<div class="form-group">
		<label for="post_status">Post Status</label>
		<select name="post_status" class='form-control'>
			<option selected value='<?php echo $edit_status; ?>'><?php echo $edit_status; ?></option>
	  		<?php 
				if($edit_status == 'published'){
					echo "<option value='draft'>Draft</option>";
				} else {
					echo "<option value='published'>Published</option>";
				}
			?>
		</select>
	</div>
	<div class="form-group">
		<label for="post_img">Post Image</label><br>
		<img src="../images/<?php echo $edit_img; ?>" alt="image" class="img-small"><br><br>
		<input type="file" name="post_img">
	</div>
	<div class="form-group">
		<label for="post_tags">Post Tags</label>
		<input type="text" value="<?php echo $edit_tags; ?>"  name="post_tags" class="form-control" placeholder="Enter Post Tags">
	</div>
	<div class="form-group">
		<label for="post_content">Post Content</label>
		<textarea name="post_content" class="form-control" placeholder="Write..." cols="30" rows="10"><?php echo $edit_content; ?></textarea>
	</div>
	<div class="form-group">
		<input type="submit" value="Update" name="update_post" class="btn btn-primary">
	</div>
</form>