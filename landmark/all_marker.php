<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
      <?php
include('../config.php');

session_start();
$strpg = "SELECT * FROM user_id  WHERE email_user = '".$_SESSION['email_user']."' ";
    $objQuery = pg_query($db,$strpg);
    $objResult = pg_fetch_array($objQuery);

    $status = $objResult[status_user];

    $idproject = $_GET[idproject];


    if($_SESSION['email_user'] == "")
    {
        header('Location: ../login.html');
        exit();
    }



$region = $_GET[region];
$prov_name  = $_GET[province];
$amp_name  = $_GET[_name];
$tam_name  = $_GET[tambon];

$strategic20 = $_GET[strategic20];
$substrategic20 = $_GET[substrategic20];
$economic_plan = $_GET[economic_plan];
$economic_target = $_GET[economic_target];
$economic_measure = $_GET[economic_measure];
$integration_29 = $_GET[integration_29];
$integration_target = $_GET[integration_target];
$project_group = $_GET[project_group];
$type_project = $_GET[type_project];
$chain_activities = $_GET[chain_activities];






?>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="icon" type="image/png" href="assets/img/Network.png">


    <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <![endif]-->
    <title>army_plan</title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME ICONS  -->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="assets/css/style.css" rel="stylesheet" />
    <!-- HTML5 Shiv and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->


    <script src="bower_components/Leaflet.draw/docs/examples/libs/leaflet-src.js"></script>
    <link rel="stylesheet" href="bower_components/Leaflet.draw/docs/examples/libs/leaflet.css" />

    <script src="bower_components/Leaflet.draw/src/Leaflet.draw.js"></script>
    <script src="bower_components/Leaflet.draw/src/Leaflet.Draw.Event.js"></script>
    <link rel="stylesheet" href="bower_components/Leaflet.draw/src/leaflet.draw.css" />

    <script src="bower_components/Leaflet.draw/src/Toolbar.js"></script>
    <script src="bower_components/Leaflet.draw/src/Tooltip.js"></script>

    <script src="bower_components/Leaflet.draw/src/ext/GeometryUtil.js"></script>
    <script src="bower_components/Leaflet.draw/src/ext/LatLngUtil.js"></script>
    <script src="bower_components/Leaflet.draw/src/ext/LineUtil.Intersect.js"></script>
    <script src="bower_components/Leaflet.draw/src/ext/Polygon.Intersect.js"></script>
    <script src="bower_components/Leaflet.draw/src/ext/Polyline.Intersect.js"></script>
    <script src="bower_components/Leaflet.draw/src/ext/TouchEvents.js"></script>

    <script src="bower_components/Leaflet.draw/src/draw/DrawToolbar.js"></script>
    <script src="bower_components/Leaflet.draw/src/draw/handler/Draw.Feature.js"></script>
    <script src="bower_components/Leaflet.draw/src/draw/handler/Draw.SimpleShape.js"></script>
    <script src="bower_components/Leaflet.draw/src/draw/handler/Draw.Polyline.js"></script>
    <script src="bower_components/Leaflet.draw/src/draw/handler/Draw.Marker.js"></script>
    <script src="bower_components/Leaflet.draw/src/draw/handler/Draw.CircleMarker.js"></script>
    <script src="bower_components/Leaflet.draw/src/draw/handler/Draw.Circle.js"></script>
    <script src="bower_components/Leaflet.draw/src/draw/handler/Draw.Polygon.js"></script>
    <script src="bower_components/Leaflet.draw/src/draw/handler/Draw.Rectangle.js"></script>

    <script src="bower_components/Leaflet.draw/src/edit/EditToolbar.js"></script>
    <script src="bower_components/Leaflet.draw/src/edit/handler/EditToolbar.Edit.js"></script>
    <script src="bower_components/Leaflet.draw/src/edit/handler/EditToolbar.Delete.js"></script>

    <script src="bower_components/Leaflet.draw/src/Control.Draw.js"></script>

    <script src="bower_components/Leaflet.draw/src/edit/handler/Edit.Poly.js"></script>
    <script src="bower_components/Leaflet.draw/src/edit/handler/Edit.SimpleShape.js"></script>
    <script src="bower_components/Leaflet.draw/src/edit/handler/Edit.Marker.js"></script>
    <script src="bower_components/Leaflet.draw/src/edit/handler/Edit.CircleMarker.js"></script>
    <script src="bower_components/Leaflet.draw/src/edit/handler/Edit.Circle.js"></script>
    <script src="bower_components/Leaflet.draw/src/edit/handler/Edit.Rectangle.js"></script>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    
    <script type="text/javascript" src="http://calvinmetcalf.github.io/leaflet-ajax/dist/leaflet.ajax.js"></script>
   



</head>

<body>



    <div class="content-wrapper">
        
          

                
                    <div class="map" id="map"></div>
               

           

        
        <!-- MENU SECTION END-->





    </div>


    <script src="assets/js/bootstrap.js"></script>



</body>
<script>
    

var osmUrl = 'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
    osmAttrib = '&copy; <a href="http://openstreetmap.org/copyright">OpenStreetMap</a> contributors',
    osm = L.tileLayer(osmUrl, {
        maxZoom: 18,
        attribution: osmAttrib
    });

//create overlayers from wms
var prov = L.tileLayer.wms("http://cgi.uru.ac.th/gs-gb/ows?", {
    layers: 'nan:site_province',
    format: 'image/png',
    transparent: true,
    attribution: 'map by <a href="http://cgi.uru.ac.th">cgi</a>'
});

var amp = L.tileLayer.wms("http://cgi.uru.ac.th/gs-gb/ows?", {
    layers: 'nan:site_amphoe',
    format: 'image/png',
    transparent: true,
    attribution: 'map by <a href="http://cgi.uru.ac.th">cgi</a>'
});

var tam = L.tileLayer.wms("http://cgi.uru.ac.th/gs-gb/ows?", {
    layers: 'nan:site_tambon',
    format: 'image/png',
    transparent: true,
    attribution: 'map by <a href="http://cgi.uru.ac.th">cgi</a>'
});

//create geoJsonLayer
// var geoJsonLayer = L.geoJson(null, {
//     pmIgnore: false
// });

<?php
    if ($prov_name == ''){
      $lat = 13.4011203;
      $lon = 100.2525025;
      $zoom = 6;
    }if ($prov_name != '' and $amphoe_name == ''){
      $result5 = pg_query($db,"SELECT ST_Y(ST_Centroid(geom)) as lat, ST_X(ST_Centroid(geom)) as long , pv_tn FROM province_sim  where pv_tn like '%$prov_name'  ;");
      $row5 = pg_fetch_array($result5); 
      $lat = $row5[lat];
      $lon = $row5[long];
      $zoom = 8;
    }if ($prov_name != '' and $amphoe_name != '' and $tambon_name == '') {
      $result5 = pg_query($db,"SELECT ST_Y(ST_Centroid(geom)) as lat, ST_X(ST_Centroid(geom)) as long , pv_tn ,ap_tn FROM amphoe_sim  where pv_tn like '%$prov_name' and ap_tn like '%$amphoe_name'  ;");
      $row5 = pg_fetch_array($result5); 
      $lat = $row5[lat];
      $lon = $row5[long];
      $zoom = 11;
    }if ($prov_name != '' and $amphoe_name != '' and $tambon_name != '') {
      $result5 = pg_query($db,"SELECT ST_Y(ST_Centroid(geom)) as lat, ST_X(ST_Centroid(geom)) as long , pv_tn ,ap_tn,tb_tn FROM tambon_sim  where pv_tn like '%$prov_name' and ap_tn like '%$amphoe_name' and tb_tn like '%$tambon_name' ;");
      $row5 = pg_fetch_array($result5); 
      $lat = $row5[lat];
      $lon = $row5[long];
      $zoom = 12;
    }
      ?>


var map = new L.Map('map', {
    center: new L.LatLng(<?php echo $lat;?>, <?php echo $lon;?>),
    zoom: <?php echo $zoom;?>
});

var polygonLayer = new L.GeoJSON.AJAX("http://www2.cgistln.nu.ac.th/budgetview/landmark/all_geojson.php?type=polygon&region=<?php echo $region; ?>&prov_name=<?php echo $prov_name; ?>&_name=<?php echo $amp_name; ?> &tam_name=<?php echo $tam_name; ?>&project_group=<?php echo $project_group; ?>&type_project=<?php echo $type_project; ?>&sub_project_group=<?php echo $sub_project_group; ?>&strategic20=<?php echo $strategic20; ?>&substrategic20=<?php echo $substrategic20; ?>&economic_plan=<?php echo $economic_plan; ?>&economic_target=<?php echo $economic_target; ?>&economic_measure=<?php echo $economic_measure; ?>&integration_29=<?php echo $integration_29; ?>&integration_target=<?php echo $integration_target; ?>&user=<?php echo $objResult[user_id]; ?>&chain_activities=<?php echo $chain_activities; ?>",{ 
    onEachFeature: onEachFeature
}).addTo(map);

var lineLayer = new L.GeoJSON.AJAX("http://www2.cgistln.nu.ac.th/budgetview/landmark/all_geojson.php?type=polyline&region=<?php echo $region; ?>&prov_name=<?php echo $prov_name; ?>&_name=<?php echo $amp_name; ?> &tam_name=<?php echo $tam_name; ?>&project_group=<?php echo $project_group; ?>&type_project=<?php echo $type_project; ?>&sub_project_group=<?php echo $sub_project_group; ?>&strategic20=<?php echo $strategic20; ?>&substrategic20=<?php echo $substrategic20; ?>&economic_plan=<?php echo $economic_plan; ?>&economic_target=<?php echo $economic_target; ?>&economic_measure=<?php echo $economic_measure; ?>&integration_29=<?php echo $integration_29; ?>&integration_target=<?php echo $integration_target; ?>&user=<?php echo $objResult[user_id]; ?>&chain_activities=<?php echo $chain_activities; ?>",{ 
    onEachFeature: onEachFeature
}).addTo(map);




var markerLayer = new L.GeoJSON.AJAX("http://www2.cgistln.nu.ac.th/budgetview/landmark/all_geojson.php?type=marker&region=<?php echo $region; ?>&prov_name=<?php echo $prov_name; ?>&_name=<?php echo $amp_name; ?> &tam_name=<?php echo $tam_name; ?>&project_group=<?php echo $project_group; ?>&type_project=<?php echo $type_project; ?>&sub_project_group=<?php echo $sub_project_group; ?>&strategic20=<?php echo $strategic20; ?>&substrategic20=<?php echo $substrategic20; ?>&economic_plan=<?php echo $economic_plan; ?>&economic_target=<?php echo $economic_target; ?>&economic_measure=<?php echo $economic_measure; ?>&integration_29=<?php echo $integration_29; ?>&integration_target=<?php echo $integration_target; ?>&user=<?php echo $objResult[user_id]; ?>&chain_activities=<?php echo $chain_activities; ?>", {

onEachFeature: onEachFeature

}).addTo(map);




function onEachFeature(feature, layer) {   
        var popupContent = '<table class="table"><tbody><tr><td>ชื่อโครงการ  </td><td>'+feature.properties.f3+'</td></tr><tr><td>กิจกรรมหลัก  </td><td>'+feature.properties.f5+'</td></tr><tr><td>กิจกรรมย่อย  </td><td>'+feature.properties.f6+'</td></tr><tr><td>กลุ่มโครงการ </td><td>'+feature.properties.f4+'</td></tr><tr><td>ห่วงโซ่คุณค่า  </td><td>'+feature.properties.f7+'</td></tr><tr><td>ผู้ดูแลโครงการ  </td><td>'+feature.properties.f8+'</td></tr></tbody></table><br><a href="../project_detail.php?prj='+feature.properties.f2+'" target="_blank" title="" class="btn btn-info" ><i class="fa fa-search"></i> ดูข้อมูล</a>' ;
          layer.bindPopup(popupContent);
  };  

L.control.layers({
    'osm': osm.addTo(map),
    "google": L.tileLayer('http://www.google.cn/maps/vt?lyrs=s@189&gl=cn&x={x}&y={y}&z={z}', {
        attribution: 'google'
    })
}, {
}).addTo(map);

var opt1 = {
    edit: {
        featureGroup: polygonLayer,
        poly: {
            allowIntersection: false,
        }
    },
    draw: {
        polygon: {
            allowIntersection: false,
            showArea: true
        },
        rectangle:false,
        polyline:false,
        circle:false,
        marker:false,        
        circlemarker:false
    }
}

var opt2 = {
    edit: {
        featureGroup: lineLayer,        
    },
    draw: {
        polygon:false,
        rectangle:false,
        polyline:{
            allowIntersection: false
        },
        circle:false,
        marker:false,        
        circlemarker:false
    }
}

var opt3 = {
    edit: {
        featureGroup: markerLayer,        
    },
    draw: {
        polygon:false,
        rectangle:false,
        polyline:false,
        circle:false,
        marker:true,        
        circlemarker:false
    }
}

// map.addControl(new L.Control.Draw(opt1));
// map.addControl(new L.Control.Draw(opt2));
// map.addControl(new L.Control.Draw(opt3));






$('#draw_line').click(function() {
    polylineDrawer.enable();
});
$('#draw_polygon').click(function() {
    polygonDrawer.enable();
});
$('#draw_marker').click(function() {
    markerDrawer.enable();
});

</script>


</html>