<?php 
require 'functions.php';
if(isset($_GET['page']) and $_GET['page'] >= 1){
	$current_page = $_GET['page'];
}
else{
	$current_page = 1; 
}

$per_page = 10;

 $start = ($current_page - 1) * $per_page;
$limit = $start + $per_page;



}

