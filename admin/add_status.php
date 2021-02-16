<?php 
require 'includes/functions.php';

$id = $_GET['id'];

$data = add_status('comments',$id);
if($data){
	header('location: manage_comments.php');
}



?>