<?php 
if(isset($_POST['checkArray'])){
  foreach($_POST['checkArray'] as $checkId){
	$bulk_opt = $_POST['bulk-opt'];
	switch($bulk_opt){
		case 'published':
			$publish_query = "UPDATE posts SET post_status = '$bulk_opt' WHERE post_id = $checkId ";
			$publish_query_result = mysqli_query($connection,$publish_query);
		break;
		case 'draft':
			$draft_query = "UPDATE posts SET post_status = '$bulk_opt' WHERE post_id = $checkId ";
			$draft_query_result = mysqli_query($connection,$draft_query);
			break;
		case 'delete':
			$del_query = "DELETE FROM posts WHERE post_id = $checkId ";
			$del_query_result = mysqli_query($connection,$del_query);
			break;
		case 'clone':
			$clone_query = "SELECT * FROM posts WHERE post_id = $checkId ";
			$clone_query_result = mysqli_query($connection,$clone_query);
			
			while($row = mysqli_fetch_assoc($clone_query_result)){
				$post_title = $row['post_title'];
				$post_author = $row['post_author'];
				$post_cat_id = $row['post_cat_id'];
				$post_status = $row['post_status'];
				$post_img = $row['post_img'];
				$post_tags = $row['post_tags'];
				$post_date = $row['post_date'];
				$post_content = $row['post_content'];
			}
				$post_query = "INSERT INTO posts (post_cat_id,post_title,post_author,post_date,post_img,post_content,post_tags,post_status) ";
				$post_query .= "VALUES ($post_cat_id,'$post_title','$post_author',now(),'$post_img','$post_content','$post_tags','$post_status' )";
				$copy_query = mysqli_query($connection,$post_query);
				confirm_query($copy_query);
			break;
		default:
			echo "<b>Please select an Option</b></br></br>";
		break;
	}
  }
} ?>
<form action="" method="post">
<table class="table table-hover table-bordered">
	<div id="bulk-opt-container" class="col-xs-4" >
		<select class="form-control" name="bulk-opt">
			<option value="" disabled selected>Select Option</option>
			<option value="published">Publish</option>
			<option value="draft">Draft</option>
			<option value="delete">Delete</option>
			<option value="clone">Clone</option>
		</select>
	</div>
	<div class="col-xs-4">
		<input type="submit" name="submit" value="Apply" class="btn btn-success">
		<a href="posts.php?source=add_post" class="btn btn-primary">Add New</a>
	</div><br><br><br>
	<thead>
		<tr>
			<th class="text-center"><input type='checkbox' id='bulkCheck'></th>
			<th class="text-center">Id</th>
			<th class="text-center">Title</th>
			<th class="text-center">Author</th>
			<th class="text-center">Category</th>
			<th class="text-center">Status</th>
			<th class="text-center">Image</th>
			<th class="text-center">Tags</th>
			<th class="text-center">Comments</th>
			<th class="text-center">Date</th>
			<th class="text-center">Views</th>
			<th class="text-center" colspan="2">Option</th>
		</tr>
	</thead>
	<tbody>
<?php 
	// Show posts from database
	$post_query = "SELECT * FROM posts ORDER BY post_id DESC";
	$post_query_result = mysqli_query($connection,$post_query);
		while($row = mysqli_fetch_assoc($post_query_result)){
			$post_id = $row['post_id'];
			$post_title = $row['post_title'];
			$post_author = $row['post_author'];
			$post_cat_id = $row['post_cat_id'];
			$post_status = $row['post_status'];
			$post_img = $row['post_img'];
			$post_tags = $row['post_tags'];
			$post_comment_count = $row['post_comment_count'];
			$post_date = $row['post_date'];
			$post_views = $row['post_views'];
			
		echo <<<END
			<tr>
				<td class='text-center'><input type='checkbox' name='checkArray[]' class='checkBoxes' value='$post_id'></td>
				<td class='text-center'>$post_id</td>
				<td class='text-center'><a href='../post.php?p_id=$post_id'>$post_title</a></td>
				<td class='text-center'>$post_author</td>
			END;
				$query = "SELECT * FROM categories WHERE cat_id = '$post_cat_id' ";			
				$select_cat = mysqli_query($connection,$query);
			while($row = mysqli_fetch_assoc($select_cat)){
				$cat_id = $row['cat_id'];
				$cat_title = $row['cat_title'];
		echo "<td class='text-center'>$cat_title</td>"; }
		echo <<<END
				<td class='text-center'>$post_status</td>
				<td class='text-center'><img src='../images/$post_img' class='img-small img-responsive'></td>
				<td class='text-center'>$post_tags</td>
				<td class='text-center'>$post_comment_count</td>
				<td class='text-center'>$post_date</td>
				<td class='text-center'><a href='posts.php?reset=$post_id' title='click to Reset'>$post_views</a></td>
				<td class='text-center'><a href='posts.php?source=edit_post&p_id=$post_id'>Edit</a></td>
				<td class='text-center'><a href='posts.php?delete=$post_id' onClick=\"javascript: return confirm('Are you sure you want to delete this Post?'); \">Delete</a></td>
			</tr>
			END;
		} ?>
	</tbody>
</table>
</form>

<?php
// delete post
if(isset($_GET['delete'])){
	$post_del_id = $_GET['delete'];
	$post_del_query = "DELETE FROM posts WHERE post_id = $post_del_id ";
	$del_query_result = mysqli_query($connection,$post_del_query);
	header("Location: posts.php");
 }

// reset post views
if(isset($_GET['reset'])){
	$reset_id = $_GET['reset'];
	$reset_query = "UPDATE posts SET post_views = 0 WHERE post_id = $reset_id";
	$res_reset_query = mysqli_query($connection,$reset_query);
	header("Location: posts.php");
 }
?>
