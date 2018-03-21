<?php

include('config.php');

header("Access-Control-Allow-Origin: *");

header('Access-Control-Allow-Headers: X-Requested-With, content-type, access-control-allow-origin, access-control-allow-methods, access-control-allow-headers');




if ($_SERVER['REQUEST_METHOD'] == 'POST') {

// get post body content
$content = file_get_contents('php://input');
// parse JSON
$user = json_decode($content, true);

$username_stu = $user['username_stu'];
$pass_stu = $user['pass_stu'];

//check duplicate $email_user
$sql2 = "SELECT * FROM student WHERE id_stu = '$username_stu' and pass_stu = '$pass_stu' ";
$result2 = pg_query( $sql2);
$add_stat = pg_fetch_array($result2);
$rowcount = pg_num_rows($result2);
if ($rowcount < 1) {
	
echo json_encode(['status' => 'error','message' => 'error'  ]);

exit;
} else{
	
echo json_encode(['status' => 'success','message' => 'success', 'id_user' => $add_stat[username_stu] 
, 'name_stu' => $add_stat[name_stu]  
, 'lname_stu' => $add_stat[lname_stu] 
, 'tel_stu' => $add_stat[tel_stu] 
, 'school' => $add_stat[school] 
, 'level_stu' => $add_stat[level_stu] 
, 'username_stu' => $add_stat[username_stu] 
, 'pass_stu' => $add_stat[pass_stu] 
, 'img' => $add_stat[img_stu]  ]);


	
}
		


}




?>