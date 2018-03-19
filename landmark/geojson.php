<?php
include('../config.php');



$type = $_GET[type];
$idproject = $_GET[idproject];
$idavtivities = $_GET[idavtivities];



$sql = "
SELECT row_to_json(fc)
 FROM ( SELECT 'FeatureCollection' As type, array_to_json(array_agg(f)) As features
 FROM (SELECT 'Feature' As type
    , ST_AsGeoJSON(a.geom)::json As geometry
    , row_to_json((name_t, a.id_project , prj_name , project_group   , budget )) As properties
   FROM feature As a  
   inner join budget_view b on a.id_project = b.prj_id

where type_g = '$type' and id_project = '$idproject' and id_activities = '$idavtivities'

   
    ) As f )  As fc;
";

   $res = pg_query($sql);
  
   while ($row = pg_fetch_row($res)) {
    echo $row[0];
  }


?>