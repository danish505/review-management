<?php 

require 'DB.php';

function create_comments($post){

	if(insert_record('comments',$post)){
	return true;
	}
	return false;
}

function create_user($post){
	if(insert_record('users',$post)){
	return true;
	}
	return false;
}

function update_comments($data,$comment_id){
	if(update('comments',$data,"where id= $comment_id")){
		return true;
	}
	return false;
}

function getall_comment_details($limit=50){
	
	global $db;

	$query = "SELECT comments.id as id,comments.title,comments.comment,comments.user_id,comments.rating,comments.status,comments.created_at,users.id,users.email as email,users.username FROM comments LEFT JOIN users ON comments.user_id = users.id where comments.status=1 ORDER BY comments.created_at DESC limit $limit";
	
	$query = $db->query($query);
	if($query->num_rows > 0){
		$result = array();
		while($data= $query->fetch_assoc()){
			$result[] = $data;
			
		}
		
		return $result;
	}
	else
	{
		return false;
	}


}

function check_login($email,$password){

	global $db;


 $query ="SELECT email FROM admin WHERE 'email'= '$email' AND 'passsword'= '$password'";
	$query = $db->query($query);
	 
	if($query){
	 	return true;
	}
	else{
		return false;
	}
}

function search_comments($title,$status,$rating){

	global $db;

	 $query = "SELECT comments.id,comments.title,comments.comment,comments.status,comments.created_at,users.id as userid,users.email  FROM comments LEFT JOIN users ON comments.user_id = users.id WHERE status = $status and title LIKE '%$title%' and rating LIKE '%$rating%'";

	$query = $db->query($query);

	if($query){
		$result = array();

		while ($data = $query->fetch_assoc()) {
			$result[] = $data;
		}
		return $result;
	}
	else{
		return array();
	}
}

function paginate($limit){


	global $db;
	$query ="SELECT count(comments.id) FROM comments";
	$query = $db->query($query);
	
			// $result = array();
	if($query){

		$row = $query->fetch_row();
		$total_records = $row[0];
		$total_pages = ceil($total_records/$limit);

		$paglink = "<ul class='pagination'>";
		for($i=1; $i<=$total_pages; $i++){
			$paglink .= "<li class='page-item'><a class='page-link' href='manage_comments.php?page=".$i."'>".$i."</a></li>";
		}
		echo $paglink . "</ul>";
	 
}
}


function show_star($rating){
	if($rating==5){
		echo "<i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i>";
	}
	else if($rating==4){
		echo "<i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star lightgray'></i>";
	}
	else if($rating==3){
		echo "<i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star lightgray'></i><i class='fa fa-star lightgray'></i>";
	}
	else if($rating==2){
		echo "<i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star lightgray'></i><i class='fa fa-star lightgray'></i><i class='fa fa-star lightgray'></i>";
	}
	else if($rating==1 or $rating==0 or $rating==""){
		echo "<i class='fa fa-star'></i><i class='fa fa-star lightgray'></i><i class='fa fa-star lightgray'></i><i class='fa fa-star lightgray'></i><i class='fa fa-star lightgray'></i>";
	}
}

function logout(){
  $_SESSION = array();
	session_destroy();

	header('location: ../login.php');
	exit();
}



 


