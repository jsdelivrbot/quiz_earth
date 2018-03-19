<?php
include('../config.php');



$sql2 = "delete from quiz
where id_quiz = '".$_GET["id_quiz"]."';"; 

$result = pg_query($sql2);



 header("Location: ../quiz.php?quiz_title=".$_GET["quiz_title"]." ");


				?>