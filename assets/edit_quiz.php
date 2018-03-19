<?php
include('../config.php');



$sql2 = "update quiz
set quiz_name = '".$_GET["quiz_name"]."' ,
chioce_1 = '".$_GET["choice1"]."' ,
chioce_2 = '".$_GET["choice2"]."',
chioce_3 = '".$_GET["choice3"]."',
chioce_4 = '".$_GET["choice4"]."',
check_chioce = '".$_GET["answer"]."',
lat = '".$_GET["lat"]."',
lon = '".$_GET["lon"]."'

where id_quiz = '".$_GET["id_quiz"]."';"; 

$result = pg_query($sql2);



 header("Location: ../quiz.php?quiz_title=".$_GET["quiz_title"]."");


				?>