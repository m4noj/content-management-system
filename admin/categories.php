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
				Categories
				<small>Author</small>
			</h1>
<div class="col-xs-6">

<!-- adding categoeries query-->
	<?php insert_categories(); ?>
	
	<form action="" method="post">
		<div class="form-group">
			<label for="cat_title">Catagory Title</label>
			<input class="form-control" type="text" name="cat_title" id="" Placeholder="Enter a Title">
		</div>
		<div class="form-group">
			<input class="btn btn-primary" type="submit" name="submit" value="Add Catagory">
		</div>
	</form><br>
	
<?php 
	// Editing categories query
	if(isset($_GET['edit'])){
	 $cat_edit_id = $_GET['edit'];
		include "includes/edit_categories.php";
 }
	?>
	</div>
	<div class="col-xs-6">
	<table class="table table-bordered table-hover">
	<thead>
		<tr>
			<th class="text-center">ID</th>
			<th class="text-center">Catagory Title</th>
			<th colspan="2" class="text-center">Option</th>
		</tr>
	</thead>
	<tbody>

<!-- find all categories query -->
<?php find_all_categories(); ?>

<!-- Deleting Categories query	-->
<?php del_categories(); ?>

		</tbody>
	</table>
</div>
</div>
</div>
<!-- /.row -->

</div>
<!-- /.container-fluid -->

</div>


<!-- /#page-wrapper -->
<?php include "includes/admin_footer.php"; ?>
