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
<?php 
	if(isset($_GET['category'])){
	$post_category_id = $_GET['category'];
	$cat_query ="SELECT * FROM `categories` WHERE cat_id =  $post_category_id ";
	$result_cat_query = mysqli_query($connection,$cat_query);
		while($cat_row = mysqli_fetch_assoc($result_cat_query)){
			$cat_title = $cat_row['cat_title'];
		}
 echo $cat_title." Posts"; ?>
	<small>Secondary Text</small>
</h1>
<?php 		
$query = "SELECT * FROM posts WHERE post_cat_id = $post_category_id ";
$posts_row = mysqli_query($connection,$query);
while($row = mysqli_fetch_assoc($posts_row)){
	$post_id = $row['post_id'];
	$post_title = $row['post_title'];
	$post_author = $row['post_author'];
	$post_date = $row['post_date'];
	$post_img = $row['post_img'];
	$post_content = substr($row['post_content'],0,150); 
	$post_status = $row['post_status'];
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
<img class="img-responsive img-900x300" src="img/<?php echo $post_img;?>" alt="">
<hr>
<p>
	<?php echo $post_content; ?>
</p>
<a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
<hr>
<?php } } 
	} else {
		header("Location: index.php"); } 
?>

<!-- First Blog Post -->




<!-- Pager -->


</div>

<!-- Blog Sidebar Widgets Column -->
<?php include "includes/sidebar.php" ?>


</div>
<!-- /.row -->

<hr>

<!-- Footer -->
<?php include "includes/footer.php" ?>