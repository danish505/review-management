<?php require 'includes/functions.php'; ?>
 <?php include('header.php');?>


 
 
<div class="container">
<div class="page-header">
<div class="pt-3 pb-3">	<h3 class="text-center"> Add Comments</h3></div>
</div>
<form method="post" action="insert_comment.php">
	
<div class="row">
		<div class="col-md-6">
	<div class="form-group">
		<label>Email</label>
		<input type="email" class="form-control" name="email" required/>
	</div>
</div>
	<div class="col-md-6">
	<div class="form-group">
		<label>Username</label>
		<input type="text" class="form-control" name="username" required/>
	</div>
	</div>
</div>
	<div class="form-group">
		<label>Title</label>
		<input type="text" class="form-control" name="title" required/>
	</div>
	<input type="hidden" name="user_id" value="1"/>
	<div class="form-group">
		<label>Comments</label>
		<textarea name="comment" class="form-control" rows="5" cols="5" required></textarea>
	</div>
		<div class="form-group">
		<label>Rating</label>
		<input type="number" min="1" max="5" class="form-control" name="rating" required/>
	</div>

	<div class="form-group">
		<label>Date</label>
		<input type="date" class="form-control" name="created_at" required/>
	</div>
	
	<br/>
	<input type="hidden" name="status" value="1"/>
	<input type="submit" class="btn btn-primary" name="submit"/>
</form>
</div>
 <?php include('footer.php');?>