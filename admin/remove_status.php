<?php 
require 'includes/functions.php';

$id = $_GET['id'];

$data = remove_status('comments',$id);
if($data){
	header('location: manage_comments.php');
}

?>