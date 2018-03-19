<?php
include('../config.php');



$sql2 = "update quiz_name
set status_quiz = '".$_GET["status"]."' 

where id_quiz_name = '".$_GET["id"]."';"; 

$result = pg_query($sql2);



 header("Location: ../quiz.php?quiz_title=".$_GET["quiz_start"]." ");


				?>