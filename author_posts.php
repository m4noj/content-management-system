<?php include "includes/db.php"; ?>
<?php include "includes/header.php"; ?>
<?php include "includes/navigation.php"; ?>

<!-- Page Content -->
<div class="container">

<div class="row">

<!-- Blog Entries Column -->
<div class="col-md-8">
	<h1 class="page-header">
		<?php echo $_GET['author']; ?> 
		<small>(Author)</small>
	</h1><br>
<?php
if(isset($_GET['p_id'])){
	$post_id = $_GET['p_id'];
	$author = $_GET['author'];

	$query = "SELECT * FROM posts WHERE post_author = '$author'";
	$result = mysqli_query($connection,$query);
		while($row = mysqli_fetch_assoc($result)){
			$post_author = $row['post_author'];
			$post_title = $row['post_title'];
			$post_date = $row['post_date'];
			$post_img = $row['post_img'];
			$post_content = $row['post_content'];
?>
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
<?php 
	}
} else {
	header("Location: index.php");
}  ?>
</div>

<!-- Blog Sidebar Widgets Column -->
<?php include "includes/sidebar.php" ?>


</div>


<!-- Footer -->
<?php include "includes/footer.php" ?>