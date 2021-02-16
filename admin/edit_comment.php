<?php require 'includes/functions.php'; ?>
 <?php include('header.php');?>

<?php 
	$id = $_GET['id'];
	$data = get_where('comments',$id);

	$date =  date('Y-m-d',$data['created_at']);
	
 ?>
 
<div class="container">
<div class="page-header">
	<h3 class="text-center">Add Comments</h3>
</div>
<form method="post" action="update_comments.php?id=<?= $data['id'];?>">
	<div class="form-group">
		<label>Title</label>
		<input type="text" class="form-control" name="title" value="<?= $data['title'];?>"/>
	</div>
	<input type="hidden" name="user_id" value="<?= $data['user_id'];?>"/>
	<div class="form-group">
		<label>Comments</label>
	<textarea class="form-control" name="comment"><?= $data['comment'];?></textarea>
	</div>
		<div class="form-group">
		<label>Rating</label>
		<input type="number" class="form-control" min="1" max="5" name="rating" value="<?= $data['rating'];?>"/>
		</div>

		<div class="form-group">
		<label>Date</label>
		<input type="date" class="form-control" name="created_at" value="<?php echo $date; ?>"/>
		</div>

	<br/>
	<input type="submit" class="btn btn-primary"/>
</form>
</div>
 <?php include('footer.php');?>