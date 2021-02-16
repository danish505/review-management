 <?php require 'includes/functions.php'; ?>
<?php include('header.php');?>



<?php

 

 ?>
<div class="container-fluid">
   <div class="page-header pt-3 pb-3">
    <h4 class="text-center">Search Comments</h4>
  </div>
</div>

<div class="container">
  
  <form method="post" action="search_comments.php">
      <div class="row">
       <div class="col-md-4">
      <div class="form-group">
         <label class="text-center">Title</label>
         <input type="text" name="title" class="form-control">
       </div>
     </div>
       <div class="col-md-4">
         <div class="form-group">
         <label class="text-center">Status</label>
         <select class="form-control" name="status">
           <option value="1">Approved</option>
           <option value="0">DisApproved</option>
         </select>
       </div>
       </div>
       <div class="col-md-4">
        <div class="row">
        <div class="col-md-8">
          <label>Rating</label>
         <input type="number" class="form-control" min="1" max="5" name="rating"/>
        </div>
        <div class="col-md-4">
          <div style="padding-top:2rem!important;">
          <input type="submit" class="btn btn-primary" value="Search"/>
        </div>
      </div>
      </div>
       </div>
        <div> 
      </div>
  </form>

  <div class="pt-3 pb-3 float-right">  <a href="add_comment.php" class="btn btn-dark">Add Comments</a></div>
  <table class="table">
    <thead>
      <tr>
        <th>id</th>
        <th class="text-center">Email</th>
        <th>title</th>
        <th>actions</th>
      </tr>
    </thead>
    <tbody>

     

        <?php 
         if(isset($run)):
        foreach($run as $dat): ?>
      <tr>
        <td><?= $dat['id']; ?></td>
        <td class="text-center"><?= $dat['email']; ?></td>
        <td><?= $dat['title']; ?></td>
      <td><a href="edit_comment.php?id=<?= $dat['id'];?>" class="btn btn-primary"><i class="fa fa-edit"></i> Edit</a><?php if($dat['status']==1){
      ?>
          <a href="remove_status.php?id=<?= $dat['id'];?>" class="btn btn-warning"> <i class="fa fa-close"></i> Disapprove</a>  
        <?php } 
        else{?>
                  <a href="add_status.php?id=<?= $dat['id'];?>" class="btn btn-success"><i class="fa fa-check"></i> Approve</a> 
        <?php } ?>
        
           <a href="delete_comment.php?id=<?= $dat['id'];?>" class="btn btn-danger"><i class="fa fa-trash"></i> Delete</a></td>
      </tr>
       <?php endforeach; ?>
 	<?php endif; ?>
      
    </tbody>
  </table>
</div>


<?php include('footer.php');?>

