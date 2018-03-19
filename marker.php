<?php
include('config.php');

header("Access-Control-Allow-Origin: *");

$sql = "SELECT * FROM quiz ";
$result = pg_query( $sql);
$coursesArray = array();

while ($row = pg_fetch_assoc($result)) {
$coursesArray[] = $row;
}
echo json_encode($coursesArray);

?>