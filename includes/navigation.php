<?php session_start(); ?>
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
<div class="container">
<div class="navbar-header">
	<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
		<span class="sr-only">Toggle navigation</span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
	</button>
	<a class="navbar-brand" href="index.php">My Blog</a>
</div>

<!-- Collect the nav links, forms, and other content for toggling -->
<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	<ul class="nav navbar-nav">
<?php 
	$query = "SELECT * FROM categories ";				
	$cat_row = mysqli_query($connection,$query);
		while($row = mysqli_fetch_assoc($cat_row)){
			$cat_title = $row['cat_title'];
			echo "<li><a href='#'>{$cat_title}</a></li>";
} ?>	
	<li><a href='admin'>Admin</a></li>			
<?php 
	if(isset($_SESSION['user_role'])){
		if(isset($_GET['p_id'])){
			$post_id = $_GET['p_id'];
			echo "<li><a href='admin/posts.php?source=edit_post&p_id={$post_id}'>Edit Post</a></li>";
			}
		}		
?>
	</ul>
</div>
</div>
</nav>
