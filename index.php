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
	$per_page = 5;
	if(isset($_GET['page'])){
		$page = $_GET['page'];
	} else {
		$page = '';
	}
	if($page == '' || $page == 1){
		$page_1 = 0;
	} else {
		$page_1 = ($page * $per_page) - $per_page;
	}

	$posts_count_query = "SELECT * FROM posts";
	$res_posts_count = mysqli_query($connection,$posts_count_query);
	$post_counts = ceil(mysqli_num_rows($res_posts_count)/5);
	
	$query = "SELECT * FROM posts WHERE post_status = 'published' ORDER BY post_id DESC LIMIT $page_1, $per_page";
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
	by <a href="author_posts.php?author=<?php echo $post_author; ?>&p_id=<?php echo $post_id; ?>">
		<?php echo $post_author; ?></a>
</p>
<p><span class="glyphicon glyphicon-time"></span> Posted on
	<?php echo $post_date; ?>
</p>
<hr>
<a href="post.php?p_id=<?php echo $post_id; ?>">
<img class="img-responsive img-900x300" src="images/<?php echo $post_img;?>" alt=""></a>
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
<br>
<hr>
<!-- pagination -->
<ul class="pager">
<?php 
	for($i = 1; $i <= $post_counts; $i++){
		if($i == $page){
			echo "<li><a href='index.php?page=$i' class='active-link'>$i</a></li>";    
		} else {
			echo "<li><a href='index.php?page=$i'>$i</a></li>";    
		}
	}
?>	
</ul>

<!-- Footer -->
<?php include "includes/footer.php" ?>