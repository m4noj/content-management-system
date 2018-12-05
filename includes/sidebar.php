<div class="col-md-4">

	<?php 
	if(isset($_POST['submit'])){
		$search = $_POST['search'];
		$query = "SELECT * FROM posts WHERE post_tags LIKE '%$search%'";
		$search_query = mysqli_query($connection,$query);
		if(!$search_query){
			die("query failed".mysqli_error($connection));	
		}
		$count = mysqli_num_rows($search_query);
		if($count == 0){
			echo "<h1>No Result</h1>";
		} else {
			echo "<h1>Result Found!</h1>";
		}
	}
?>
	<!-- Blog Search Well -->
<div class="well">
<h4>Search</h4>
<form action="" method="post">
<div class="input-group">
	<input name="search" type="text" class="form-control">
	<span class="input-group-btn">
		<button name="submit" class="btn btn-default" type="submit">
			<span class="glyphicon glyphicon-search"></span>
		</button>
	</span>
</div>
</form>
</div>


<!-- Login form -->
<div class="well">
<h4>Log In</h4>
<form action="includes/login.php" method="post">
<div class="form-group">
	<input name="username" type="text" class="form-control" placeholder="Username">
</div>
<div class="form-group">
	<input type="password" name="password" placeholder="Password" class="form-control">
</div>
<input type="submit" value="Log In" name="log_in" class="btn btn-primary">
</form>
</div>










<!-- Blog Categories Well -->
<div class="well">
	<h4>Blog Categories</h4>
<div class="row">
	<div class="col-lg-12">
		<ul class="list-unstyled">
	<?php 
		$query = "SELECT * FROM categories ";			
		$cat_sidebar = mysqli_query($connection,$query);
			while($row = mysqli_fetch_assoc($cat_sidebar)){
				$cat_id = $row['cat_id'];
				$cat_title = $row['cat_title'];
				echo "<li><a href='category.php?category=$cat_id'>{$cat_title}</a></li>";
			}
	?>
		</ul>
	</div>
		<!-- /.col-lg-6 -->
		<!-- /.col-lg-6 -->
	</div>
	<!-- /.row -->
</div>

<!-- Side Widget Well -->
<?php include "widget.php"; ?>

</div>