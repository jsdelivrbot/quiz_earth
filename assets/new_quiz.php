<?php
include('../config.php');

$seed = str_split('abcdefghijklmnopqrstuvwxyz'
.'ABCDEFGHIJKLMNOPQRSTUVWXYZ'
.'0123456789'); 
shuffle($seed);
$rand = '';
foreach (array_rand($seed, 6) as $k) $rand .= $seed[$k];



$name_quiz = $_GET[quiz_start];
				$sql = "INSERT INTO quiz_name (quiz_title,token) values ('$name_quiz','$rand')"; 
				$result = pg_query($sql);



header("Location: ../new_quiz.php?quiz_start=$name_quiz");


				?>