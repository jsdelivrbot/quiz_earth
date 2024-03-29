<?php
include('../config.php');
$type = $_GET[type];
$sql = "SELECT jsonb_build_object(
    'type',     'FeatureCollection',
    'features', jsonb_agg(feature)
)
FROM (
  SELECT jsonb_build_object(
    'type',       'Feature',
    'id',         gid,
    'geometry',   ST_AsGeoJSON(geom)::jsonb,
    'properties', to_jsonb(row) - 'gid' - 'geom'
  ) AS feature
  FROM (SELECT * FROM feature where type_g = '$type') row) features;";

   $res = pg_query($sql);
  
   while ($row = pg_fetch_row($res)) {
    echo $row[0];
  }


?>