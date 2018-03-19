<?php
include('../config.php');



$sql2 = "insert into quiz 
( quiz_title,quiz_name, chioce_1, chioce_2, chioce_3, chioce_4, check_chioce,lat,lon)
values 
(  '".$_GET["quiz_title"]."' ,'".$_GET["quiz_name"]."' , '".$_GET["choice1"]."' , '".$_GET["choice2"]."', '".$_GET["choice3"]."', '".$_GET["choice4"]."', '".$_GET["answer"]."', '".$_GET["lat"]."', '".$_GET["lon"]."');"; 

$result = pg_query($sql2);



 header("Location: ../quiz.php?quiz_title=".$_GET["quiz_title"]."");


				?>