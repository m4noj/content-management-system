<?php 
if(!isset($_GET['id'])){
	header("Location: posts.php?error=denied");
} else {
	$post_id = $_GET['id'];
}
?>

<?php include "includes/admin_header.php"; ?>

<div id="wrapper">

<!-- Navigation -->
<?php include "includes/admin_navigation.php"; ?>

<div id="page-wrapper">

<div class="container-fluid">

	<!-- Page Heading -->
<div class="row">
<div class="col-lg-12">
<h1 class="page-header">
	All Comments
		<small>[Post title]</small>
	</h1>


<table class="table table-hover table-bordered">
	<thead>
		<tr>
			<th class="text-center">Id</th>
			<th class="text-center">Comment</th>
			<th class="text-center">Author</th>
			<th class="text-center">Email</th>
			<th class="text-center">Status</th>
			<th class="text-center">In Responce to</th>
			<th class="text-center">Date</th>
			<th class="text-center" colspan="3">Option</th>
		</tr>
	</thead>
	<tbody>
		<?php 
	// Show all comments from database
	$post_id = mysqli_real_escape_string($connection,$post_id);
	$comments_query = "SELECT * FROM comments where comment_post_id = $post_id ";
	$comments_query_result = mysqli_query($connection,$comments_query);
		if(mysqli_num_rows($comments_query_result) == 0 ){
			echo "</tbody></table><h3 class='text-center'>No comments yet.</h3>";
		}
		while($row = mysqli_fetch_assoc($comments_query_result)){
			$comment_id = $row['comment_id'];
			$comment_post_id = $row['comment_post_id'];
			$comment = $row['comment'];
			$comment_author = $row['comment_author'];
			$comment_email = $row['comment_email'];
			$comment_status = $row['comment_status'];
			$comment_date = $row['comment_date'];
		echo "
			<tr>
				<td class='text-center'>$comment_id</td>
				<td class='text-center'>$comment</td>
				<td class='text-center'>$comment_author</td>
				<td class='text-center'>$comment_email</td> 
				<td class='text-center'>$comment_status</td>";
	
				$post_query = "SELECT * FROM posts WHERE post_id = '$comment_post_id' ";			
				$post_query_result = mysqli_query($connection,$post_query);
			while($post_row = mysqli_fetch_assoc($post_query_result)){
				$post_id = $post_row['post_id']; 
				$post_title = $post_row['post_title']; 
		 echo " <td class='text-center'><a href='../post.php?p_id=$post_id'>$post_title</a></td>"; }
		 echo "	<td class='text-center'>$comment_date</td>
				<td class='text-center'><a href='post_comments.php?approve=$comment_id&id=$post_id'>Approve</a></td>
				<td class='text-center'><a href='post_comments.php?unapprove=$comment_id&id=$post_id'>Unapprove</a></td>
				<td class='text-center'><a href='post_comments.php?delete=$comment_id&id=$post_id'>Delete</a></td>
			</tr>";
	} 
?>
	</tbody>
</table>

<?php 

// approve comments
if(isset($_GET['approve'])){
	$approve_id = $_GET['approve'];
	$approve_query = "UPDATE comments SET comment_status = 'Approved' WHERE comment_id = $approve_id ";
	$approve_result = mysqli_query($connection,$approve_query);
	header("Location: post_comments.php?id=$post_id");
  }


// Unapprove comments
if(isset($_GET['unapprove'])){
	$unapprove_id = $_GET['unapprove'];
	$unapprove_query = "UPDATE comments SET comment_status = 'Unapproved' WHERE comment_id = $unapprove_id " ;
	$unapprove_result = mysqli_query($connection,$unapprove_query);
	header("Location: post_comments.php?id=$post_id");
  }


// delete comments
if(isset($_GET['delete'])){
	$comment_del_id = $_GET['delete'];
	$comment_del_query = "DELETE FROM comments WHERE comment_id = $comment_del_id ";
	$del_query_result = mysqli_query($connection,$comment_del_query);
	header("Location: post_comments.php?id=$post_id");
  }

?>
	
																				
</div>

<!-- /.row -->
</div>
<!-- /.container-fluid -->

</div>


<!-- /#page-wrapper -->
<?php include "includes/admin_footer.php"; ?>