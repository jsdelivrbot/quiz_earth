<?php

include('../config.php');

header("Access-Control-Allow-Origin: *");

header('Access-Control-Allow-Headers: X-Requested-With, content-type, access-control-allow-origin, access-control-allow-methods, access-control-allow-headers');



if ($_SERVER['REQUEST_METHOD'] == 'POST') {

// get post body content
$content = file_get_contents('php://input');
// parse JSON
$user = json_decode($content, true);

$name_stu = $user['name_stu'];
$lname_stu = $user['lname_stu'];
$tel_stu = $user['tel_stu'];
$school = $user['school'];
$level_stu = $user['level_stu'];
$username_stu = $user['username_stu'];
$pass_stu = $user['pass_stu'];
$img64 = $user['img64'];  



//check duplicate $email_user
$sql2 = "SELECT * FROM student WHERE id_stu = '$username_stu' ";
$result2 = pg_query($sql2);
$rowcount = pg_num_rows($result2);
if ($rowcount == 1) {
echo json_encode(['status' => 'error','message' => 'error-email']);

}else{

    $sql = "INSERT INTO student (name_stu, lname_stu, tel_stu , school, level_stu, id_stu, pass_stu, img_stu) 
    VALUES ('$name_stu', '$lname_stu', $tel_stu, '$school', '$level_stu', '$username_stu','$pass_stu', '$img64');";
    
    $result = pg_query($sql);
    
    
    
    if ($result) {
    echo json_encode(['status' => 'ok','message' => 'success']);
    } else {
    echo json_encode(['status' => 'error','message' => 'error-other']);
    }

} 
	






}




?>