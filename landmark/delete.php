<?php
include('../config.php');
   
   
    $name_t = $_POST['name_t'];
    //echo $name_t;
    $sql = "DELETE FROM feature WHERE name_t='$name_t'";    
    pg_query($sql);
    echo 'delete:'.$name_t;
?>