<?php include "includes/db.php"; ?>
<?php include "includes/header.php"; ?>
<!-- Navigation -->
<?php include "includes/navigation.php"; ?>

<!-- Page Content -->
<div class="container">

<div class="row">

<!-- Blog Entries Column -->
<div class="col-md-8">
<h1 class="page-header">
	All Recent Posts
	<small>Secondary Text</small>
</h1>

<?php 
$query = "SELECT * FROM posts WHERE post_status = 'published' ";
$posts_row = mysqli_query($connection,$query);
while($row = mysqli_fetch_assoc($posts_row)){
	$post_id = $row['post_id'];
	$post_title = $row['post_title'];
	$post_author = $row['post_author'];
	$post_date = $row['post_date'];
	$post_img = $row['post_img'];
	$post_status = $row['post_status'];
	$post_content = substr($row['post_content'],0,150); 
	if($post_status == 'published'){
?>

<h2>
	<a href="post.php?p_id=<?php echo $post_id; ?>">
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
<a href="post.php?p_id=<?php echo $post_id; ?>">
<img class="img-responsive img-900x300" src="img/<?php echo $post_img;?>" alt=""></a>
<hr>
<p>
	<?php echo $post_content; ?>
</p>
<a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

<hr>
<?php } } ?>
</div>

<!-- Blog Sidebar Widgets Column -->
<?php include "includes/sidebar.php" ?>


</div>
<!-- /.row -->

<hr>

<!-- Footer -->
<?php include "includes/footer.php" ?>