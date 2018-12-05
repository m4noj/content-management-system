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
	$comments_query = "SELECT * FROM comments ";
	$comments_query_result = mysqli_query($connection,$comments_query);
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
				<td class='text-center'><a href='comments.php?approve=$comment_id'>Approve</a></td>
				<td class='text-center'><a href='comments.php?unapprove=$comment_id'>Unapprove</a></td>
				<td class='text-center'><a href='comments.php?delete=$comment_id'>Delete</a></td>
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
	header("Location: comments.php");
  }


// Unapprove comments
if(isset($_GET['unapprove'])){
	$unapprove_id = $_GET['unapprove'];
	$unapprove_query = "UPDATE comments SET comment_status = 'Unapproved' WHERE comment_id = $unapprove_id " ;
	$unapprove_result = mysqli_query($connection,$unapprove_query);
	header("Location: comments.php");
  }


// delete comments
if(isset($_GET['delete'])){
	$comment_del_id = $_GET['delete'];
	$comment_del_query = "DELETE FROM comments WHERE comment_id = $comment_del_id ";
	$del_query_result = mysqli_query($connection,$comment_del_query);
	header("Location: comments.php");
  }

?>
