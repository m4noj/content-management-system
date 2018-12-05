<?php include "includes/db.php"; ?>
<?php include "includes/header.php"; ?>
<!-- Navigation -->
<?php include "includes/navigation.php"; ?>
<?php
// GET the post id and display that post 
if(isset($_GET['p_id'])){
	$post_id = $_GET['p_id'];
	$query = "SELECT * FROM posts WHERE post_id = $post_id";
	$result = mysqli_query($connection,$query);
		while($row = mysqli_fetch_assoc($result)){
			$post_author = $row['post_author'];
			$post_title = $row['post_title'];
			$post_date = $row['post_date'];
			$post_img = $row['post_img'];
			$post_content = $row['post_content'];
		}	
	} else {
		header("Location: index.php");
	} 
?>

<!-- Page Content -->
<div class="container">

<div class="row">

<!-- Blog Entries Column -->
<div class="col-md-8">
<!--
	<h1 class="page-header">
		Page Heading
		<small>Secondary Text</small>
	</h1>
--> <br><br>
	<h2>
			<a href="#">
			<?php echo $post_title; ?></a>
	</h2>
	<p class="lead">
		by <a href="index.php">
			<?php echo $post_author; ?></a>
	</p>
	<p><span class="glyphicon glyphicon-time"></span> Posted on
		<?php echo $post_date; ?>
	</p>
	<hr>
	<img class="img-responsive img-900x300" src="img/<?php echo $post_img;?>" alt="">
	<hr>
	<p>
		<?php echo $post_content; ?>
	</p>
	<hr>

<!-- Comments Form -->
<div class="well">
<h4>Leave a Comment:</h4>
<form action="" method="post">
	<div class="form-group">
		<input type="text" name="comment_author" class="form-control" placeholder="Author">
	</div>
	<div class="form-group">
		<input type="email" name="comment_email" class="form-control" placeholder="Email">
	</div>
	<div class="form-group">
		<textarea class="form-control" name="comment" rows="3" placeholder="Comment Here..."></textarea>
	</div>
	<button type="submit" class="btn btn-primary" name="post_comment">Comment</button>
</form>
</div>
<hr>
<!-- posting the comments in database -->
<?php 
if(isset($_POST['post_comment'])){
	$comment_post_id = $_GET['p_id'];
	$comment_author = $_POST['comment_author'];
	$comment_email = $_POST['comment_email'];
	$comment = $_POST['comment'];
	$comment_status = "Unapproved";
	$comment_date = date('d-m-y');
	
$post_comment_query = "INSERT INTO comments (comment_post_id, comment,comment_author,comment_email, comment_status, comment_date) ";
$post_comment_query .= "VALUES ($comment_post_id, '$comment', '$comment_author', '$comment_email','$comment_status',now() ) ";
$result_comment_query = mysqli_query($connection,$post_comment_query);
	// increase the commment count for a new comment in posts table.
$cmt_count_query ="UPDATE posts SET post_comment_count = post_comment_count + 1 ";
$cmt_count_query .= "WHERE post_id = $post_id";
$cmt_count_result = mysqli_query($connection,$cmt_count_query);
	}
	
?>

<?php 
// show individual comments from database	
$comment_query = "SELECT * FROM comments WHERE comment_post_id = $post_id AND comment_status = 'Approved' ORDER BY comment_id DESC ";
	$result_comment_query = mysqli_query($connection,$comment_query);
	while($comment_row = mysqli_fetch_assoc($result_comment_query)){
		$comment_author = $comment_row['comment_author'];
		$comment = $comment_row['comment'];
		$comment_date = $comment_row['comment_date'];
	?>

<!-- Comment -->
<div class="media">
<a class="pull-left" href="#">
<img class="img-responsive img-64x64" src="images/users/avatar.png" alt="">
</a>
<div class="media-body">
	<h4 class="media-heading"><?php echo $comment_author; ?>
		<small><?php echo $comment_date; ?></small>
	</h4><?php echo $comment; ?></div><br><br>
</div><?php  } ?>




</div>

<!-- Blog Sidebar Widgets Column -->
<?php include "includes/sidebar.php" ?>


</div>
<!-- /.row -->

<hr>

<!-- Footer -->
<?php include "includes/footer.php" ?>