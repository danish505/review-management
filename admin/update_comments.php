<?php 
require('includes/functions.php');
	$id = $_GET['id'];
	$data['title'] = $_POST['title'];
	$data['comment'] = $_POST['comment'];
	$data['rating']  = $_POST['rating'];
	
	$date = $_POST['created_at'];
	$date = strtotime($date);

	$data['created_at'] = $date;

	$data['user_id'] = $_POST['user_id'];


	 $result = update('comments',$data,$id);
	 if($result){
		header('location: manage_comments.php');
	 } 

?>