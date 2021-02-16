<?php
$db = new mysqli('localhost','kaamdjep_editingsquad','U8NyR=%2Ib)&','kaamdjep_editingsquad');
if (mysqli_connect_errno()){
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

function create_order($data){
	if(insert_record('orders',$data)){
		return true;
	}
	return false;
}
function update_order($data,$order_key){
	if(update('orders',$data,"where order_key='$order_key'")){
		return true;
	}
	return false;
}
function order($order_key){
	global $db;
	$query = "SELECT orders.* , category.name as category, service.name as service,deadline.name as deadline,subject.name as subject, academic_level.name as academic_level, user.email as user_email
		FROM orders
		LEFT JOIN academic_level on orders.academic_level_id = academic_level.id
		LEFT JOIN category on orders.category_id = category.id
		LEFT JOIN service on orders.service_id = service.id
		LEFT JOIN subject on orders.subject_id = subject.id
		LEFT JOIN deadline on orders.deadline_id = deadline.id
		LEFT JOIN user on orders.user_id = user.id
		where orders.order_key = '$order_key'";
	
	$query = $db->query($query);
	if($query->num_rows > 0){
		return  $query->fetch_assoc(); 
	}else{
		return array();
	}
}

function get_record($table,$where="",$fields=null){
	global $db;
	

	if(is_null($fields)){
		$fields = '*';
	}else{
		$fields = implode(',', $fields);
	}
	$query = "select $fields from $table $where";
	$query = $db->query($query);
	
	if($query->num_rows > 0){
		
		$result= array();
		
		while ($data = $query->fetch_assoc()) {
			$result[] = $data;	
		}
		return $result;
		
	}else{
		return array();
	}
}

function get_comment_with_user($start,$per_page){
	
	global $db;

	$query = "SELECT comments.id as id,comments.title,comments.comment,comments.user_id,comments.rating,comments.status,users.id as userid,users.email as email FROM comments LEFT JOIN users ON comments.user_id = users.id ORDER BY comments.id DESC LIMIT $start,$per_page";
	$query = $db->query($query);
	if($query->num_rows > 0){
		$result = array();
		while($data= $query->fetch_assoc()){
			$result[] = $data;
			
		}
		
		return $result;
	}
	else{
		return false;
	}


}

function insert_user($data){
	global $db;

 	$email = $data['email'];
	$username = $data['username']; 	
 	
 	 $query = "INSERT INTO users('email','username') VALUES('$email','$username')";
	
	$query = $db->query($query);
	
	if($query){

		$last_id ="SELECT * FROM users ORDER BY id DESC LIMIT 1";
		$last_id = $db->query($last_id);
		$user_id = $last_id->fetch_assoc();
		print_r($user_id);
		return $user_id;

	}
	else{
		echo 'data not inserted';
	}
}


function get_where($table,$id,$fields=null){

	global $db;
	
	 $query = "SELECT * FROM $table where id = $id";
	$query = $db->query($query);
	
	if($query->num_rows > 0){
		
	$data = $query->fetch_assoc();

		return $data;
	}
	else{
		return array();
	}
}
function get_user($table,$email,$fields=null){

	global $db;
	
	 $query = "SELECT id FROM $table WHERE email = '$email'";
	$query = $db->query($query);
	
	if($query)
	{
		
	$data = $query->fetch_assoc();

	return $data;
		 
	}
	else{
	return array();
	}
}

function remove_where($table,$id,$fields=null){
	global $db;
	
	$query = "DELETE from $table where id = $id";
	$query = $db->query($query);
	
	if($query->num_rows > 0){
		

		
	$data = $query->fetch_assoc();

		return $data;
		
	}
	else{
		return array();
	}
}

function add_status($table,$id,$fields=null){
	global $db;
	$status = 1;
	$query = "update $table SET status = $status where id = $id";
	$query = $db->query($query);
	
	if($query){
		return true;
	}
	else{
		return false;
	}
}

function remove_status($table,$id,$fields=null){

	global $db;
	$status = 0;
	$query = "update $table SET status = $status where id = $id";
	$query = $db->query($query);
	
	if($query){

		return true;		
	}
	else{
		return false;
	}
}

function categories(){
	global $db;
	$query = "select * from category where status = 1";
	$query = $db->query($query);
	if($query->num_rows > 0){
		$result = array();
		 while($row = $query->fetch_assoc()){
		 	$result[] = $row;
		 } 
		 return $result;
	}else{
		return array();
	}
}
function serices_by_category($category_id){
	global $db;
	$query = "select * from service where category_id = '$category_id'  and status = 1 ";
	$query = $db->query($query);
	if($query->num_rows > 0){
		$result = array();
		 while($row = $query->fetch_assoc()){
		 	$result[] = $row;
		 } 
		 return $result;
	}else{
		return array();
	}
}
function academic_by_category($category_id){
	global $db;
	$query = "select * from academic_level where category_id = '$category_id'  and status = 1 ";
	$query = $db->query($query);
	if($query->num_rows > 0){
		$result = array();
		 while($row = $query->fetch_assoc()){
		 	$result[] = $row;
		 } 
		 return $result;
	}else{
		return array();
	}
}

function get_price($category_id,$service_id,$academic_id,$deadline_id){
	global $db;
	$query = "SELECT price.id,price.price ,deadline.name as dead_line , category.name as category , service.name as service , academic_level.name as academic_level 
		from price

		LEFT join category on  category.id = price.category_id
		LEFT join service on service.id = price.service_id
		LEFT JOIN academic_level on  academic_level.id = price.academic_level_id
		LEFT JOIN category_deadline on category_deadline.id = price.category_deadline_id
        LEFT JOIN deadline on deadline.id = category_deadline.deadline_id 
        

		where category.id = '$category_id' and 
		service.id = '$service_id' and 
		academic_level.id  = '$academic_id' and 
		deadline.id = '$deadline_id'
		";
	$query = $db->query($query);
	if($query->num_rows > 0){
		$result = array();
		 while($row = $query->fetch_assoc()){
		 	$result[] = $row;
		 } 
		 return $result;
	}else{
		return array();
	}
}

 

function nearest_deadline($date,$category_id){
	global $db;
	$seconds = seconds_diff($date);
	$query = $db->query("SELECT id, name, ABS( seconds - $seconds ) AS distance, deadline_id FROM (
	(
		SELECT deadline.seconds,deadline.name,category_deadline.id,category_deadline.deadline_id
		FROM `category_deadline`
        left JOIN deadline on deadline.id = category_deadline.deadline_id
		WHERE seconds <= '$seconds' and category_deadline.category_id = '$category_id'
		ORDER BY seconds
		LIMIT 6
	)
) AS n
ORDER BY distance
LIMIT 1");
	
	return $query->fetch_assoc(); 
}


function get_id($table,$order='desc'){
	global $db;
	$query = $db->query("select id from $table order by id $order limit 1");
	if($query->num_rows > 0){
		return $query->fetch_assoc()['id'];
	}else{
		return false;
	}

}

function get_val($table,$val,$where){
	global $db;
	$query = "select $val from $table $where limit 1";
	$query = $db->query($query);
	if($query->num_rows > 0){
		return $query->fetch_assoc()[$val];
	}else{
		return false;
	}
}

// insert function
function insert_query_data($data){
    global $db;
    foreach (array_keys($data) as $key => $value) {
         if($key == 0){
             $query_data = "(";
         }
         $query_data.= " $value ";
         if($key < count($data)-1){
             $query_data .= ",";
         }else{
             $query_data .=")";
         }
     }

     $query_data .= " values";

     foreach (array_values($data) as $key => $value) {
         if($key == 0){
             $query_data .= "(";
         }
         $value =  $db->real_escape_string($value);
         $query_data.= " '$value' ";
         if($key < count($data)-1){
             $query_data .= ",";
         }else{
             $query_data .=")";
         }
     }

     return  $query_data;
}
function insert_record($table,$data){
    global $db;
    $query_data = insert_query_data($data);
      $query_ = "insert into $table $query_data";
    $query= $db->query($query_);

    if($query){
        return true;
    }else{
        return false;
    }
}
//update function

function update_query_data($data){

    $query = '';
    foreach ($data as $key => $d) {
        $query .= $key." =  '$d',";
    }
    $query = rtrim($query,',');
    return $query;
}

function update($table,$data,$id){
	global $db;
 
    $set_fields = update_query_data($data);
    $query = "update $table set $set_fields where id = $id";
	$queryRun = $db->query($query);

    if($queryRun){
        return true;
    }else{
        return false;
    }
}


function record_exist($table,$where=""){
    global $db;
    $query = $db->query("select id from $table $where ");
    
    if($query->num_rows > 0){
        $query->fetch_assoc()['id'];
        return true;
    }else{
        return false;
    }
}

function order_key($user_id,$fname,$lname){
    $certificate_series = 'eh-';
    $characters = '-';
    $c_len = strlen($characters);
    $start = rand(10,17);

    // generate unique id
    
    $id = md5(uniqid($user_id, true));

    // get selected between unique id
    $id = substr($id, $start ,strlen($id)-1);
    
    // get 5 affiliate_id    
    $id = substr($id, strlen($id)-5,strlen($id)-1);
    
    // add character between affiliate_id
    //$id[rand(0,4)] = substr($characters, rand(0,strlen($characters)-1),1);

    // add random text/id into affliate_id
    $id = random_tex(). "{$id}".substr($user_id, strlen($user_id)-1).random_tex();
    
    return  $id;

}

function random_tex($length = 2) {
   $characters =  'abcdefghijklmnopqrstuvwxyz';
   $charactersLength = strlen($characters);
   $randomString = '';
   for ($i = 0; $i < $length; $i++) {
       $randomString .= $characters[rand(0, $charactersLength - 1)];
   }
   return $randomString;
}

function name($full_name){
   if(strpos($full_name,' ') !== false){
       $full_name = explode(' ',$full_name);
       $first_name = $full_name[0];
       $last_name = implode(' ',$full_name);
       $last_name = str_replace($first_name.' ','',$last_name);
   }
   else{
       $first_name = $full_name;
       $last_name = '';
   }
   return array('first_name'=>$first_name,'last_name'=>$last_name);
}
?>