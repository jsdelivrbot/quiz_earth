<?php
$hostname_db = "119.59.125.189";
$database_db = "isnre";
$username_db = "postgres";
$password_db = "##isnre@postgis##";

$db = pg_connect("host=$hostname_db user=$username_db password=$password_db dbname=$database_db") or die("Can't Connect Server");

pg_query("SET client_encoding = 'utf-8'"); 



$id_user = $_GET[id_user];

$sql = "SELECT * FROM user_profile where id_user = '$id_user';";

$result = pg_query($db,$sql);
$coursesArray = array();

while ($row = pg_fetch_assoc($result)) {
$coursesArray[] = $row;
}
echo json_encode($coursesArray);
?>