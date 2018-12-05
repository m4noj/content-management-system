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
		Dashboard
		<small><?php // Echo Username and User Role
			if(isset($_SESSION['username'])){
					echo $_SESSION['firstname']." "."[".$_SESSION['user_role']."]";
				} ?>
		</small>
	</h1>
</div>

	
<!-- Dashboard Panels  -->
</div>
<div class="row">

<div class="col-lg-3 col-md-6">
<div class="panel panel-primary">
<div class="panel-heading">
<div class="row">
	<div class="col-xs-3">
		<i class="fa fa-file-text fa-5x"></i>
	</div>
	<div class="col-xs-9 text-right">
	<?php 
		$post_query = "SELECT * FROM posts ";
		$result_post_query = mysqli_query($connection,$post_query);
		$post_counts = mysqli_num_rows($result_post_query);
		echo "<div class='huge'>$post_counts</div>"; 
		?>
		<div>Posts</div>
	</div>
</div>
</div>
<a href="posts.php">
	<div class="panel-footer">
		<span class="pull-left">View Details</span>
		<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
		<div class="clearfix"></div>
	</div>
</a>
</div>
</div>

<div class="col-lg-3 col-md-6">
<div class="panel panel-red">
<div class="panel-heading">
	<div class="row">
		<div class="col-xs-3">
			<i class="fa fa-list fa-5x"></i>
		</div>
		<div class="col-xs-9 text-right">
		<?php 
			$category_query = "SELECT * FROM categories ";
			$result_category_query = mysqli_query($connection,$category_query);
			$category_counts = mysqli_num_rows($result_category_query);
			echo "<div class='huge'>$category_counts</div>";
		?>
			 <div>Categories</div>
		</div>
	</div>
</div>
<a href="categories.php">
	<div class="panel-footer">
		<span class="pull-left">View Details</span>
		<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
		<div class="clearfix"></div>
	</div>
</a>
</div>
</div>

<div class="col-lg-3 col-md-6">
<div class="panel panel-green">
<div class="panel-heading">
	<div class="row">
		<div class="col-xs-3">
			<i class="fa fa-comments fa-5x"></i>
		</div>
		<div class="col-xs-9 text-right">
		<?php 
			$comments_query = "SELECT * FROM comments ";
			$result_comments_query = mysqli_query($connection,$comments_query);
			$comment_counts = mysqli_num_rows($result_comments_query);
			echo "<div class='huge'>$comment_counts</div>"; 
		?>		  
		<div>Comments</div>
		</div>
	</div>
</div>
<a href="comments.php">
	<div class="panel-footer">
		<span class="pull-left">View Details</span>
		<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
		<div class="clearfix"></div>
	</div>
</a>
</div>
</div>

<div class="col-lg-3 col-md-6">
<div class="panel panel-yellow">
<div class="panel-heading">
	<div class="row">
		<div class="col-xs-3">
			<i class="fa fa-user fa-5x"></i>
		</div>
		<div class="col-xs-9 text-right">
		<?php 
			$users_query = "SELECT * FROM users ";
			$result_users_query = mysqli_query($connection,$users_query);
			$user_counts = mysqli_num_rows($result_users_query);
			echo "<div class='huge'>$user_counts</div>"; 
		?>
			<div> Users</div>
		</div>
	</div>
</div>
<a href="users.php">
	<div class="panel-footer">
		<span class="pull-left">View Details</span>
		<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
		<div class="clearfix"></div>
	</div>
</a>
</div>
</div>



</div><br>
<!-- Dashboard Panels ends here -->

<?php 
// adding few more colums to charts 

// draft posts column 
$draft_query = "SELECT * FROM posts WHERE post_status = 'draft' ";
$res_draft_query = mysqli_query($connection,$draft_query);
$draft_counts = mysqli_num_rows($res_draft_query);

	
// unapproved comments column
$unapr_comment_query = "SELECT * FROM comments WHERE comment_status = 'Unapproved' ";
$res_unapr_comment_query = mysqli_query($connection,$unapr_comment_query);
$unapr_counts = mysqli_num_rows($res_unapr_comment_query);

// Subscribers column
$subscribers_query = "SELECT * FROM users WHERE usr_role = 'subscriber' ";
$res_subscribers = mysqli_query($connection,$subscribers_query);
$subs_counts = mysqli_num_rows($res_subscribers);
?>

<!-- Chart -->
<div class="row">
 <script type="text/javascript">
  google.charts.load('current', {'packages':['bar']});
  google.charts.setOnLoadCallback(drawChart);

 function drawChart() {
	 var data = google.visualization.arrayToDataTable([
	  ['Data', 'Counts'],

	<?php

	// Inserting dynamic data into Chart from database

	 $element_text = ['Active Posts','Draft Posts','Categories','Comments','Pending Comments','Users','Subscribers'];
	 $element_count = [$post_counts,$draft_counts,$category_counts,$comment_counts,$unapr_counts,$user_counts,$subs_counts];

	for($i = 0; $i < 7 ; $i++){
			echo "['$element_text[$i]'" . "," . "$element_count[$i]],";	

		}
	?>
 ]);

	var options = {
	  chart: {
		title: 'Blog Analysis',
		subtitle: 'Dynamic Chart',
	  }
	};

	var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

	chart.draw(data, google.charts.Bar.convertOptions(options));
  }
</script>
<div id="columnchart_material" style="auto; height: 500px;"></div>
</div>
 
</div>
<!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->
<?php include "includes/admin_footer.php"; ?>
