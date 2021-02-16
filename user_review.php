<?php

require('admin/includes/functions.php');

$post['username'] = $_POST['username'];
$post['email'] = $_POST['email'];

$date = $_POST['created_at'];
 
$date = strtotime($date); 
 
$email = $post['email'];

$check = get_user('users',$email);


$user = create_user($post);

if($user){

		$last_id ="SELECT * FROM users ORDER BY id DESC LIMIT 1";
		$last_id = $db->query($last_id);
		$user_id = $last_id->fetch_assoc();
		
		$data['title'] = $_POST['title'];
		$data['comment'] = $_POST['comment'];
		$data['rating'] = $_POST['rating'];
		$data['status'] = $_POST['status'];
		$data['created_at'] = time();
		$data['user_id'] = $user_id['id'];

		$comment = create_comments($data);
		if($comment){
			echo "comment_ok";
		}
	}
	else if($check){
		$data['title'] = $_POST['title'];
		$data['comment'] = $_POST['comment'];
		$data['rating'] = $_POST['rating'];
		$data['user_id'] = $check['id'];
		$data['status'] = $_POST['status'];
		$data['created_at'] = time();
		$comment = create_comments($data);
		if($comment){
		echo "comment_ok";
		}

	}
