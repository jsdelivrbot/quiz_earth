<?php
include('../config.php');

header("Access-Control-Allow-Origin: *");




if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // get post body content
    $content = file_get_contents('php://input');
    // parse JSON
    $user = json_decode($content, true);
    
    $id_stu = $user['id_stu'];

$sql = "SELECT * FROM stu_include a
inner join quiz_name b on a.id_quiz_name = b.id_quiz_name
where a.id_stu =  $id_stu;";
$result = pg_query( $sql);
$coursesArray = array();

while ($row = pg_fetch_assoc($result)) {
$coursesArray[] = $row;
}
echo json_encode($coursesArray);


}



?>