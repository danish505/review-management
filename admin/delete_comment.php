<?php 
 require('includes/functions.php');
$id = $_GET['id'];
 
$remove_data = remove_where('comments',$id);
header('location: manage_comments.php');

?>