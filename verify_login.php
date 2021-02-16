<?php 
session_start();
require('admin/includes/functions.php');
$email = trim($_POST['email']);
$password = trim($_POST['password']);
$password = md5($password);

$data = check_login($email,$password);
if($data){
	$_SESSION['email'] = $email;
	 $_SESSION['email'];
	header('location: admin/dashboard.php');
}
else{
	$_SESSION['error'] = "User is not registered";
	header('location: login.php');
}

?>