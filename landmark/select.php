<?php
include('../config.php');

// $sql = "SELECT jsonb_build_object(
//     'type',     'FeatureCollection',
//     'features', jsonb_agg(feature)
// )
// FROM (
//   SELECT jsonb_build_object(
//     'type',       'Feature',
//     'id',         gid,
//     'geometry',   ST_AsGeoJSON(geom)::jsonb,
//     'properties', to_jsonb(row) - 'gid' - 'geom'
//   ) AS feature
//   FROM (SELECT * FROM feature) row) features;";


$sql1 = 'select * from feature';

$res = pg_query($sql);
  
   while ($row = pg_fetch_row($res)) {
    echo $row;
  }

?>